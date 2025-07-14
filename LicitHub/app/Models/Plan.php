<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'trial_days',
        'interval',
        'is_active',
        'features',
        'features_off',
        'stripe_price_id'  
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'trial_days' => 'integer',
        'is_active' => 'boolean',
        "features" => "array",
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
