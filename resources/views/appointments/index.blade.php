@extends('adminlte::page')

@section('title', 'Citas | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
@section('content_header')

    <div class="appointments-header">

        <div>
            <span class="header-eyebrow">
                <i class="fas fa-leaf mr-1"></i>
                NUTRIADMIN
            </span>

            <h1>Calendario</h1>

            <p>Organiza y consulta las citas de tus pacientes.</p>
        </div>

        <a href="{{ route('citas.create') }}" class="btn-liquid-primary">
            <i class="fas fa-plus"></i>
            <span>Nueva cita</span>
        </a>

    </div>

@stop


{{-- =========================================================
     CONTENT
     ========================================================= --}}
@section('content')

    @php
        /*
        |--------------------------------------------------------------------------
        | Datos para el calendario (se serializan a JSON en @section('js')

    @vite(['resources/js/theme.js'])
)
        |--------------------------------------------------------------------------
        */
        $calendarAppointments = $appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'date' => $appointment->appointment_at->format('Y-m-d H:i:s'),
                'patient' => trim(
                    ($appointment->patient->first_name ?? '') . ' ' .
                    ($appointment->patient->last_name ?? '')
                ),
                'reason' => $appointment->reason ?? 'Consulta nutricional',
                'status' => $appointment->status ?? 'Pendiente',
                'edit_url' => route('citas.edit', $appointment),
                'cancel_url' => route('citas.cancel', $appointment),
                'delete_url' => route('citas.destroy', $appointment),
            ];
        })->values();

        $upcomingAppointments = $appointments
            ->filter(function ($appointment) {
                return $appointment->appointment_at >= now()->startOfDay();
            })
            ->sortBy('appointment_at')
            ->take(5);
    @endphp

    <div class="nutri-calendar-page">

        <div class="ambient ambient-one"></div>
        <div class="ambient ambient-two"></div>
        <div class="ambient ambient-three"></div>

        @if(session('success'))
            <div class="glass-alert">
                <div class="glass-alert-icon">
                    <i class="fas fa-check"></i>
                </div>

                <div>
                    <strong>¡Listo!</strong>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif


        {{-- =================================================
             HERO
             ================================================= --}}
        @include('appointments.partials.index-hero')


        {{-- =================================================
             MÉTRICAS
             ================================================= --}}
        @include('appointments.partials.index-stats')


        {{-- =================================================
             CALENDARIO
             ================================================= --}}
        @include('appointments.partials.index-calendar')

    </div>

@stop


{{-- =========================================================
     ESTILOS
     ========================================================= --}}
@section('css')

    {{-- Anti-parpadeo: aplica el tema guardado ANTES de pintar la página --}}
    @include('partials.theme-init-script')


    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    @vite(['resources/css/nutriadmin.css'])

@stop


{{-- =========================================================
     SCRIPTS
     ========================================================= --}}
@section('js')

    {{-- Solo pasamos los datos del servidor a JS; toda la lógica
         del calendario vive en resources/js/pages/appointments-index.js --}}
    <script>
        window.appointmentsIndexData = {
            appointments: @json($calendarAppointments),
            csrfToken: @json(csrf_token()),
        };
    </script>

    @vite(['resources/js/pages/appointments-index.js'])

@stop
