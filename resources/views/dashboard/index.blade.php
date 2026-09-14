@extends('adminlte::page')

@section('title', 'Dashboard | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
@section('content_header')

    @include('dashboard.partials.header')

@stop


{{-- =========================================================
     DASHBOARD CONTENT
     ========================================================= --}}
@section('content')

    @php
        /*
        |--------------------------------------------------------------------------
        | Valores predeterminados
        |--------------------------------------------------------------------------
        | Se mantienen temporalmente aquí para no alterar la lógica actual
        | del dashboard. Más adelante podemos mover esta lógica al
        | DashboardController.
        */

        $totalPatients = $totalPatients ?? 0;
        $activePatients = $activePatients ?? 0;

        $inactivePatients = max($totalPatients - $activePatients, 0);

        $activePercentage = $totalPatients > 0
            ? round(($activePatients / $totalPatients) * 100)
            : 0;

        $todayAppointmentsCount = $todayAppointmentsCount ?? 0;
        $monthAppointments = $monthAppointments ?? 0;
        $monthIncome = $monthIncome ?? 0;
        $completedAppointments = $completedAppointments ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Datos de gráficas
        |--------------------------------------------------------------------------
        */

        $patientChartLabels = $patientChartLabels ?? ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];
        $patientChartData = $patientChartData ?? [0, 0, 0, 0, 0, $totalPatients];

        $appointmentChartLabels = $appointmentChartLabels ?? ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
        $appointmentChartData = $appointmentChartData ?? [0, 0, 0, 0, 0, 0, $todayAppointmentsCount];

        $incomeChartLabels = $incomeChartLabels ?? ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];
        $incomeChartData = $incomeChartData ?? [0, 0, 0, 0, 0, $monthIncome];

        /*
        |--------------------------------------------------------------------------
        | Crecimiento
        |--------------------------------------------------------------------------
        */

        $patientGrowth = $patientGrowth ?? 0;
        $appointmentGrowth = $appointmentGrowth ?? 0;
        $incomeGrowth = $incomeGrowth ?? 0;
    @endphp


    {{-- =====================================================
         DECORACIÓN GENERAL
         ===================================================== --}}
    <div class="dashboard-background">

        <div class="dashboard-background__blob dashboard-background__blob--one"></div>
        <div class="dashboard-background__blob dashboard-background__blob--two"></div>
        <div class="dashboard-background__blob dashboard-background__blob--three"></div>


        {{-- =================================================
             HERO
             ================================================= --}}
        @include('dashboard.partials.hero')


        {{-- =================================================
             MÉTRICAS PRINCIPALES
             ================================================= --}}
        @include('dashboard.partials.metrics')


        {{-- =================================================
             GRÁFICAS
             ================================================= --}}
        @include('dashboard.partials.charts')


        {{-- =================================================
             RESUMEN + ACCIONES RÁPIDAS
             ================================================= --}}
        <div class="dashboard-bottom-grid">
            @include('dashboard.partials.summary')
            @include('dashboard.partials.quick-actions')
        </div>


        {{-- =================================================
             FOOTER
             ================================================= --}}
        @include('dashboard.partials.footer')

    </div>

@stop


{{-- =========================================================
     ESTILOS
     ========================================================= --}}
@section('css')

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Solo pasamos los datos del servidor a JS; toda la lógica
         de las gráficas vive en resources/js/dashboard.js --}}
    <script>
        window.dashboardData = {
            patients: {
                labels: @json($patientChartLabels),
                data: @json($patientChartData),
            },
            patientStatus: {
                active: {{ $activePatients }},
                inactive: {{ $inactivePatients }},
            },
            appointments: {
                labels: @json($appointmentChartLabels),
                data: @json($appointmentChartData),
            },
            income: {
                labels: @json($incomeChartLabels),
                data: @json($incomeChartData),
            },
        };
    </script>

    @vite(['resources/js/dashboard.js'])

@stop
