<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientChatController extends Controller
{
    public function index()
    {
        // Encontrar administradores (assumindo que eles têm user_type = 'admin')
        $admins = User::where('user_type', 'admin')->get();
        
        // Selecionar o primeiro admin por padrão ou o admin especificado
        $selectedAdmin = request('admin_id') ? User::find(request('admin_id')) : $admins->first();
        
        $messages = [];
        if ($selectedAdmin) {
            // Marcar mensagens como lidas
            ChatMessage::where('from_user_id', $selectedAdmin->id)
                ->where('to_user_id', Auth::id())
                ->where('is_read', false)
                ->update(['is_read' => true, 'read_at' => now()]);
            
            // Buscar todas as mensagens entre o cliente e o admin selecionado
            $messages = ChatMessage::where(function($query) use ($selectedAdmin) {
                $query->where('from_user_id', Auth::id())
                      ->where('to_user_id', $selectedAdmin->id);
            })->orWhere(function($query) use ($selectedAdmin) {
                $query->where('from_user_id', $selectedAdmin->id)
                      ->where('to_user_id', Auth::id());
            })->orderBy('created_at')->get();
        }
        
        return view('client.chat.index', compact('admins', 'selectedAdmin', 'messages'));
    }
    
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'to_user_id' => 'required|exists:users,id',
        ]);
        
        ChatMessage::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
            'is_read' => false,
        ]);
        
        // Usar o padrão POST-REDIRECT-GET para evitar reenvio do formulário
        return redirect()->route('client.chat', ['admin_id' => $request->to_user_id]);
    }
    
    public function getNewMessages(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:users,id',
            'last_message_id' => 'nullable|integer',
        ]);
        
        $query = ChatMessage::where(function($q) use ($request) {
            $q->where('from_user_id', Auth::id())
              ->where('to_user_id', $request->admin_id);
        })->orWhere(function($q) use ($request) {
            $q->where('from_user_id', $request->admin_id)
              ->where('to_user_id', Auth::id());
        });
        
        if ($request->last_message_id) {
            $query->where('id', '>', $request->last_message_id);
        }
        
        $messages = $query->orderBy('created_at')->get();
        
        // Marcar mensagens como lidas
        ChatMessage::where('from_user_id', $request->admin_id)
            ->where('to_user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        return response()->json([
            'messages' => $messages,
            'last_id' => $messages->count() ? $messages->last()->id : $request->last_message_id
        ]);
    }
}
