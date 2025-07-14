<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class AdminPlanController extends Controller
{
    // Listar todos os planos
    public function index()
    {
        $plans = Plan::latest()->paginate(10);
        return view("admin.plans.index", compact("plans"));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view("admin.plans.create");
    }

    // Armazenar novo plano
    public function store(Request $request)
{
    $request->validate([
        "name" => "required|string|max:255|unique:plans",
        "slug" => "required|string|max:255|unique:plans",
        "description" => "nullable|string",
        "price" => "required|numeric|min:0",
        "trial_days" => "nullable|integer|min:0",
        "interval" => "required|in:month,year",
        "is_active" => "boolean",
        "features" => "nullable|array",
        "features_off" => "nullable|array",
        "stripe_price_id" => "nullable|string"
    ]);

    Plan::create([
        "name" => $request->name,
        "slug" => $request->slug,
        "description" => $request->description,
        "price" => $request->price,
        "trial_days" => $request->trial_days ?? 0,
        "interval" => $request->interval,
        "is_active" => $request->is_active ?? true,
        "features" => json_encode($request->features ?? []),
        "features_off" => json_encode($request->features_off ?? []),
        "stripe_price_id" => $request->stripe_price_id
    ]);

    return redirect()->route("plans.index")
        ->with("success", "Plano criado com sucesso.");
}


    // Mostrar detalhes de um plano
    public function show(Plan $plan)
    {
        return view("admin.plans.show", compact("plan"));
    }

    // Mostrar formulário de edição
    public function edit(Plan $plan)
    {
        return view("admin.plans.edit", compact("plan"));
    }

    // Atualizar plano existente
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            "name" => "required|string|max:255|unique:plans,name,".$plan->id,
            "slug" => "required|string|max:255|unique:plans,slug,".$plan->id,
            "description" => "nullable|string",
            "price" => "required|numeric|min:0",
            "trial_days" => "nullable|integer|min:0",
            "interval" => "required|in:month,year",
            "is_active" => "boolean",
            "features" => "nullable|array",
            "features_off" => "nullable|array", // <-- faltava isso
            "stripe_price_id" => "nullable|string"
        ]);

        $plan->update([
            "name" => $request->name,
            "slug" => $request->slug,
            "description" => $request->description,
            "price" => $request->price,
            "trial_days" => $request->trial_days ?? $plan->trial_days,
            "interval" => $request->interval,
            "is_active" => $request->is_active ?? $plan->is_active,
            "features" => json_encode($request->features ?? []), // <-- sempre encode arrays
            "features_off" => json_encode($request->features_off ?? []),
            "stripe_price_id" => $request->stripe_price_id ?? $plan->stripe_price_id
        ]);

        return redirect()->route("plans.index")
            ->with("success", "Plano atualizado com sucesso.");
    }

    // Excluir plano
    public function destroy(Plan $plan)
    {
        // Verificar se há assinaturas antes de deletar
        if ($plan->subscriptions()->count() > 0) {
            return redirect()->back()
                ->with("error", "Não é possível excluir este plano pois existem assinaturas ativas.");
        }
        
        $plan->delete();

        return redirect()->route("plans.index")
            ->with("success", "Plano excluído com sucesso.");
    }
}