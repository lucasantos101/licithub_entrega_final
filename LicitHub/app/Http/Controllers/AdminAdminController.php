<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAdminController extends Controller
{
    public function index()
    {
        // Corrigido para buscar "admin" em vez de "admins"
        $admins = User::where("user_type", "admin")->paginate(10);
        return view("admin.admins.index", compact("admins"));
    }

    public function create()
    {
        return view("admin.admins.create");
    }

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
            "user_type" => "admin",
        ]);

        return redirect()->route("admins.index")
            ->with("success", "Admin criado com sucesso.");
    }

    public function show(User $admin)
    {
        // Corrigido para verificar se É admin
        if ($admin->user_type !== 'admin') {
            abort(404);
        }
        return view("admin.admins.show", compact("admin"));
    }

    public function edit(User $admin)
    {
        if ($admin->user_type !== 'admin') {
            abort(404);
        }
        return view("admin.admins.edit", compact("admin"));
    }

    public function update(Request $request, User $admin)
    {
        if ($admin->user_type !== 'admin') {
            abort(404);
        }
        
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email," . $admin->id,
            "user_type" => "required|in:customer,employee,admin",
        ]);

        $admin->update([
            "name" => $request->name,
            "email" => $request->email,
            "user_type" => $request->user_type,
        ]);

        if ($request->filled("password")) {
            $request->validate([
                "password" => "string|min:8|confirmed",
            ]);
            
            $admin->update([
                "password" => Hash::make($request->password),
            ]);
        }

        return redirect()->route("admins.index")
            ->with("success", "Admin atualizado com sucesso.");
    }

    public function destroy(User $admin)
    {
        // Corrigido para verificar se É admin
        if ($admin->user_type !== 'admin') {
            abort(404);
        }
        
        $admin->delete();

        return redirect()->route("admins.index")
            ->with("success", "Admin excluído com sucesso.");
    }
}