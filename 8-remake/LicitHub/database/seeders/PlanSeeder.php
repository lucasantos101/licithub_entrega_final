<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run()
    {
        Plan::create([
            "name" => "Plano Básico",
            "slug" => "basico",
            "description" => "Acesso essencial aos recursos.",
            "price" => 10.00,
            "interval" => "month",
            "is_active" => true,
            "stripe_price_id" => "price_1RRROTQZYlGh3UzqVpcHQJzq", // Substitua pelo ID real do Stripe
            "features" => json_encode(["Recurso 1", "Recurso 2"])
        ]);

        Plan::create([
            "name" => "Plano Premium",
            "slug" => "premium",
            "description" => "Acesso completo e suporte prioritário.",
            "price" => 20.00,
            "interval" => "month",
            "is_active" => true,
            "stripe_price_id" => "price_1RTEFZQZYlGh3UzqyX7ZoWOx", // Substitua pelo ID real do Stripe
            "features" => json_encode(["Recurso 1", "Recurso 2", "Recurso 3", "Suporte Prioritário"])
        ]);
    }
}