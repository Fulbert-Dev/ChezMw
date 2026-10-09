<?php

namespace App\Http\Controllers;

class BailleurDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('bailleur.dashboard', compact('user'));
    }
}
