<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)
        ->orderBy('price', 'asc') // Ordena por preço crescente
        ->get();

return view('welcome', compact('plans'));
    }
}