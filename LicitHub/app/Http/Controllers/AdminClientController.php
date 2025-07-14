<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Adicione este import

class AdminClientController extends Controller
{
    // Método para listar clientes
    public function index(Request $request)
{
    $search = $request->input('search');
    
    $clients = User::where('user_type', 'customer')
        ->when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "¨%{$search}%");
            });
        })
        ->with(['cashiersubscriptions' => function($query) {
            $query->where('stripe_status', 'active')
                  ->where(function($q) {
                      $q->whereNull('ends_at')
                        ->orWhere('ends_at', '>', now());
                  });
        }])
        ->orderBy('id', 'asc')
        ->paginate(10); // Reduzi para 10 itens por página para melhor performance

    return view('admin.clients.index', compact('clients'));
}
    // Método para mostrar o formulário de criação
    public function create()
    {
        return view("admin.clients.create");
    }

    // Método para salvar um novo cliente
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8|confirmed",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "user_type" => "customer", // Define como cliente
        ]);

        return redirect()->route("clients.index")
            ->with("success", "Cliente criado com sucesso.");
    }

    // Método para mostrar detalhes de um cliente
    public function show(User $client) // Use Route Model Binding
    {
        // Garante que só mostre se for cliente (opcional, mas seguro)
        if ($client->user_type !== 'customer') {
            abort(404);
        }
        return view("admin.clients.show", compact("client"));
    }

    // Método para mostrar o formulário de edição
    public function edit(User $client) // Use Route Model Binding
    {
        if ($client->user_type !== 'customer') {
            abort(404);
        }
        return view("admin.clients.edit", compact("client"));
    }

    // Método para atualizar um cliente existente
    public function update(Request $request, User $client) // Use Route Model Binding
    {
        if ($client->user_type !== 'customer') {
            abort(404);
        }
        
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email," . $client->id,
            "user_type" => "required|in:customer,employee,admin",
        ]);

        $client->update([
            "name" => $request->name,
            "email" => $request->email,
            "user_type" => $request->user_type,
        ]);

        if ($request->filled("password")) {
            $request->validate([
                "password" => "string|min:8|confirmed",
            ]);
            
            $client->update([
                "password" => Hash::make($request->password),
            ]);
        }

        return redirect()->route("clients.index")
            ->with("success", "Cliente atualizado com sucesso.");
    }

    // Método para excluir um cliente
    public function destroy(User $client) // Use Route Model Binding
    {
        if ($client->user_type !== 'customer') {
            abort(404);
        }
        
        $client->delete();

        return redirect()->route("clients.index")
            ->with("success", "Cliente excluído com sucesso.");
    }
}
