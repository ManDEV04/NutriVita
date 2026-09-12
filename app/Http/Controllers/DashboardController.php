<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::where('user_id', Auth::id())
            ->count();

        $activePatients = Patient::where('user_id', Auth::id())
            ->where('active', true)
            ->count();

        return view('dashboard', compact(
            'totalPatients',
            'activePatients'
        ));
    }
}