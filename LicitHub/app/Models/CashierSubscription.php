<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashierSubscription extends Model
{
    protected $table = 'cashier_subscriptions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}