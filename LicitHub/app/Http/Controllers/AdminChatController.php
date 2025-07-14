<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{
    public function index()
    {
        $clients = User::where('user_type', 'customer')->get();
        $selectedClient = request('client_id') ? User::find(request('client_id')) : null;
        
        $messages = [];
        if ($selectedClient) {
            // Marcar mensagens como lidas
            ChatMessage::where('from_user_id', $selectedClient->id)
                ->where('to_user_id', Auth::id())
                ->where('is_read', false)
                ->update(['is_read' => true, 'read_at' => now()]);
            
            $messages = ChatMessage::where(function($query) use ($selectedClient) {
                $query->where('from_user_id', Auth::id())
                      ->where('to_user_id', $selectedClient->id);
            })->orWhere(function($query) use ($selectedClient) {
                $query->where('from_user_id', $selectedClient->id)
                      ->where('to_user_id', Auth::id());
            })->orderBy('created_at')->get();
        }
        
        // Contar mensagens não lidas para cada cliente
        foreach ($clients as $client) {
            $client->unread_count = ChatMessage::where('from_user_id', $client->id)
                ->where('to_user_id', Auth::id())
                ->where('is_read', false)
                ->count();
        }
        
        return view('admin.chat.index', compact('clients', 'selectedClient', 'messages'));
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
        
        return redirect()->route('admin.chat', ['client_id' => $request->to_user_id])
            ->with('success', 'Mensagem enviada.');
    }
    
    // Método para buscar novas mensagens via AJAX
    public function getNewMessages(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'last_message_id' => 'nullable|integer',
        ]);
        
        $query = ChatMessage::where(function($q) use ($request) {
            $q->where('from_user_id', Auth::id())
              ->where('to_user_id', $request->client_id);
        })->orWhere(function($q) use ($request) {
            $q->where('from_user_id', $request->client_id)
              ->where('to_user_id', Auth::id());
        });
        
        if ($request->last_message_id) {
            $query->where('id', '>', $request->last_message_id);
        }
        
        $messages = $query->orderBy('created_at')->get();
        
        // Marcar mensagens como lidas
        ChatMessage::where('from_user_id', $request->client_id)
            ->where('to_user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        return response()->json([
            'messages' => $messages,
            'last_id' => $messages->count() ? $messages->last()->id : $request->last_message_id
        ]);
    }
}
