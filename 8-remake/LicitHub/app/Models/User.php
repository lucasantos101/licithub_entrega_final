<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use App\Notifications\CustomResetPassword;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable, Billable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'user_type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function cashierSubscriptions()
{
    return $this->hasMany(\App\Models\CashierSubscription::class);
}

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function hasActiveCashierSubscription()
{
    return $this->cashierSubscriptions()
        ->where('stripe_status', 'active')
        ->where(function($query) {
            $query->whereNull('ends_at')
                  ->orWhere('ends_at', '>', now());
        })
        ->exists();
}

    public function noCashierSubscription()
    {
        return ! $this->cashierSubscriptions()->exists();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    public function isOnline()
    {
        return DB::table('sessions')
            ->where('user_id', $this->id)
            ->where('last_activity', '>=', Carbon::now()->subMinutes(5)->timestamp)
            ->exists();
    }
}

