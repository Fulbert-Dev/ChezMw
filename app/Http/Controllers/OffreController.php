<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('offres.index', compact('user'));
    }
}
