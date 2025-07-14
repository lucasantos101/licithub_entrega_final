<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashierTables extends Migration
{
    public function up()
    {
        // Tabela de assinaturas do Cashier
        Schema::create('cashier_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'stripe_status']);
        });

        // Tabela de itens de assinatura do Cashier
        Schema::create('cashier_subscription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id');
            $table->string('stripe_id')->unique();
            $table->string('stripe_product');
            $table->string('stripe_price');
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->unique(['subscription_id', 'stripe_price']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cashier_subscription_items');
        Schema::dropIfExists('cashier_subscriptions');
    }
}
