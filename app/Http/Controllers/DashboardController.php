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

        $user = Auth::user();

        // ==========================================
        // PRUEBA GRATUITA DE 7 DÍAS
        // ==========================================

        $trialDaysRemaining = null;
        $isTrialActive = false;

        if (
            $user &&
            $user->subscription_status === 'trial' &&
            $user->trial_ends_at
        ) {
            $trialDaysRemaining = now()
                ->startOfDay()
                ->diffInDays(
                    $user->trial_ends_at->copy()->startOfDay(),
                    false
                );

            $isTrialActive = $trialDaysRemaining >= 0;
        }

        return view('dashboard.index', compact(
            'totalPatients',
            'activePatients',
            'trialDaysRemaining',
            'isTrialActive'
        ));
    }
}