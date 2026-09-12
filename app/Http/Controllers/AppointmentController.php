<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->with('patient')
            ->orderBy('appointment_at')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
    $patients = \App\Models\Patient::where('user_id', Auth::id())
        ->where('active', true)
        ->orderBy('first_name')
        ->get();

    return view('appointments.create', compact('patients'));
}

    public function store(Request $request)
    {
         $validated = $request->validate([
        'patient_id' => ['required', 'exists:patients,id'],
        'appointment_at' => ['required', 'date'],
        'reason' => ['nullable', 'string', 'max:255'],
        'status' => ['required', 'in:Pendiente,Confirmada,Cancelada,Completada'],
        'notes' => ['nullable', 'string', 'max:2000'],
    ]);

    $patient = \App\Models\Patient::where('id', $validated['patient_id'])
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $validated['user_id'] = Auth::id();
    $validated['patient_id'] = $patient->id;

    Appointment::create($validated);

    return redirect()
        ->route('citas.index')
        ->with('success', 'Cita registrada correctamente.');
}

    public function show(Appointment $cita)
    {
        //
    }

    public function edit(Appointment $cita)
    {
        //
    }

    public function update(Request $request, Appointment $cita)
    {
        //
    }

    public function cancel(Appointment $cita)
{
    abort_if($cita->user_id !== Auth::id(), 403);

    $cita->update([
        'status' => 'Cancelada',
    ]);

    return redirect()
        ->route('citas.index')
        ->with('success', 'Cita cancelada correctamente.');
}

    public function destroy(Appointment $cita)
{
    abort_if($cita->user_id !== Auth::id(), 403);

    $cita->delete();

    return redirect()
        ->route('citas.index')
        ->with('success', 'Cita eliminada definitivamente.');
}
}