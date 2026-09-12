@extends('adminlte::page')

@section('title', 'Dashboard | NutriAdmin')


@section('content_header')

@php

    $totalPatients = $totalPatients ?? 0;
    $activePatients = $activePatients ?? 0;

    $inactivePatients = max(
        $totalPatients - $activePatients,
        0
    );

    $activePercentage = $totalPatients > 0
        ? round(($activePatients / $totalPatients) * 100)
        : 0;


    /*
    |--------------------------------------------------------------------------
    | DATOS OPCIONALES
    |--------------------------------------------------------------------------
    | Si luego los enviamos desde el controlador, las gráficas
    | comenzarán a mostrar información real.
    */

    $todayAppointmentsCount =
        $todayAppointmentsCount ?? 0;

    $monthAppointments =
        $monthAppointments ?? 0;

    $monthIncome =
        $monthIncome ?? 0;

    $completedAppointments =
        $completedAppointments ?? 0;


    /*
    |--------------------------------------------------------------------------
    | GRÁFICAS
    |--------------------------------------------------------------------------
    */

    $patientChartLabels =
        $patientChartLabels ??
        ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];

    $patientChartData =
        $patientChartData ??
        [0, 0, 0, 0, 0, $totalPatients];


    $appointmentChartLabels =
        $appointmentChartLabels ??
        ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];

    $appointmentChartData =
        $appointmentChartData ??
        [0, 0, 0, 0, 0, 0, $todayAppointmentsCount];


    $incomeChartLabels =
        $incomeChartLabels ??
        ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];

    $incomeChartData =
        $incomeChartData ??
        [0, 0, 0, 0, 0, $monthIncome];


    /*
    |--------------------------------------------------------------------------
    | CRECIMIENTO
    |--------------------------------------------------------------------------
    */

    $patientGrowth = $patientGrowth ?? 0;
    $appointmentGrowth = $appointmentGrowth ?? 0;
    $incomeGrowth = $incomeGrowth ?? 0;

@endphp


<div class="dashboard-header">

    <div>

        <span class="header-eyebrow">

            <i class="fas fa-leaf mr-1"></i>

            NUTRIADMIN

        </span>


        <h1>

            Hola,
            {{ Auth::user()->name }}
            <span>👋</span>

        </h1>


        <p>

            Aquí tienes un resumen del estado actual
            de tu consultorio.

        </p>

    </div>


    <div class="header-date">

        <div class="date-icon">
            <i class="far fa-calendar"></i>
        </div>

        <div>

            <small>HOY</small>

            <strong>
                {{ now()->translatedFormat('d \d\e F, Y') }}
            </strong>

        </div>

    </div>

</div>

@stop




@section('content')


<div class="nutri-dashboard">


    {{-- ILUMINACIÓN AMBIENTAL --}}
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>
    <div class="ambient ambient-three"></div>



    {{-- ======================================================
         HERO
    ======================================================= --}}

    <div class="dashboard-hero">


        <div class="hero-left">


            <div class="hero-icon">

                <i class="fas fa-chart-line"></i>

            </div>


            <div>

                <span class="hero-label">

                    RESUMEN DE TU CONSULTORIO

                </span>


                <h2>

                    Todo bajo
                    <span>control.</span>

                </h2>


                <p>

                    Consulta tus pacientes, citas,
                    actividad e indicadores principales
                    desde un mismo lugar.

                </p>

            </div>

        </div>



        <div class="hero-health">


            <div class="health-circle">

                <div class="health-value">

                    {{ $activePercentage }}

                    <span>%</span>

                </div>


                <small>

                    pacientes
                    activos

                </small>

            </div>


            <div class="floating-leaf leaf-hero-one">

                <i class="fas fa-leaf"></i>

            </div>


            <div class="floating-leaf leaf-hero-two">

                <i class="fas fa-seedling"></i>

            </div>


        </div>


    </div>




    {{-- ======================================================
         MÉTRICAS
    ======================================================= --}}

    <div class="metrics-grid">


        {{-- PACIENTES --}}
        <div class="metric-card">


            <div class="metric-card-top">


                <div class="metric-icon patients-icon">

                    <i class="fas fa-user-friends"></i>

                </div>


                <span class="metric-growth positive">

                    <i class="fas fa-arrow-up"></i>

                    {{ abs($patientGrowth) }}%

                </span>


            </div>


            <span class="metric-label">

                Pacientes activos

            </span>


            <h3>

                {{ $activePatients }}

            </h3>


            <div class="metric-footer">

                <span>

                    {{ $totalPatients }}
                    registrados

                </span>


                <strong>

                    {{ $activePercentage }}%

                </strong>

            </div>


            <div class="metric-progress">

                <div
                    class="metric-progress-value"
                    style="width: {{ $activePercentage }}%"
                ></div>

            </div>


        </div>



        {{-- CITAS --}}
        <div class="metric-card">


            <div class="metric-card-top">


                <div class="metric-icon appointments-icon">

                    <i class="far fa-calendar-check"></i>

                </div>


                <span class="metric-growth positive">

                    <i class="fas fa-arrow-up"></i>

                    {{ abs($appointmentGrowth) }}%

                </span>


            </div>


            <span class="metric-label">

                Citas de hoy

            </span>


            <h3>

                {{ $todayAppointmentsCount }}

            </h3>


            <div class="metric-footer">

                <span>

                    {{ $monthAppointments }}
                    este mes

                </span>


                <strong>

                    Agenda

                </strong>

            </div>


            <div class="metric-progress">

                <div
                    class="metric-progress-value appointment-progress"
                    style="width: {{ min($todayAppointmentsCount * 12, 100) }}%"
                ></div>

            </div>


        </div>



        {{-- CONSULTAS TERMINADAS --}}
        <div class="metric-card">


            <div class="metric-card-top">


                <div class="metric-icon completed-icon">

                    <i class="fas fa-check-double"></i>

                </div>


                <span class="metric-mini">

                    MES

                </span>


            </div>


            <span class="metric-label">

                Consultas completadas

            </span>


            <h3>

                {{ $completedAppointments }}

            </h3>


            <div class="metric-footer">

                <span>

                    Seguimiento realizado

                </span>


                <strong>

                    <i class="fas fa-check-circle"></i>

                </strong>

            </div>


            <div class="metric-progress">

                <div
                    class="metric-progress-value completed-progress"
                    style="width: {{ min($completedAppointments * 10, 100) }}%"
                ></div>

            </div>


        </div>



        {{-- INGRESOS --}}
        <div class="metric-card">


            <div class="metric-card-top">


                <div class="metric-icon money-icon">

                    <i class="fas fa-wallet"></i>

                </div>


                <span
                    class="metric-growth
                    {{ $incomeGrowth >= 0 ? 'positive' : 'negative' }}"
                >

                    <i class="fas
                        {{ $incomeGrowth >= 0
                            ? 'fa-arrow-up'
                            : 'fa-arrow-down'
                        }}">
                    </i>

                    {{ abs($incomeGrowth) }}%

                </span>


            </div>


            <span class="metric-label">

                Ingresos del mes

            </span>


            <h3 class="money-value">

                ${{ number_format($monthIncome, 0) }}

            </h3>


            <div class="metric-footer">

                <span>

                    Ingresos registrados

                </span>


                <strong>

                    MXN

                </strong>

            </div>


            <div class="metric-progress">

                <div
                    class="metric-progress-value money-progress"
                    style="width: {{ $monthIncome > 0 ? 70 : 0 }}%"
                ></div>

            </div>


        </div>


    </div>




    {{-- ======================================================
         GRÁFICAS GRANDES
    ======================================================= --}}

    <div class="main-charts-grid">



        {{-- CRECIMIENTO PACIENTES --}}
        <div class="glass-chart-card">


            <div class="chart-header">


                <div>

                    <span class="chart-eyebrow">

                        CRECIMIENTO

                    </span>


                    <h4>

                        Pacientes registrados

                    </h4>


                    <p>

                        Evolución de pacientes
                        durante los últimos meses.

                    </p>

                </div>


                <div class="chart-badge">

                    <i class="fas fa-chart-line"></i>

                    Últimos 6 meses

                </div>


            </div>


            <div class="chart-container large-chart">

                <canvas id="patientsGrowthChart"></canvas>

            </div>


        </div>



        {{-- ESTADO PACIENTES --}}
        <div class="glass-chart-card">


            <div class="chart-header">


                <div>

                    <span class="chart-eyebrow">

                        PACIENTES

                    </span>


                    <h4>

                        Estado actual

                    </h4>


                    <p>

                        Distribución de pacientes
                        activos e inactivos.

                    </p>

                </div>


            </div>



            <div class="doughnut-wrapper">


                <div class="doughnut-container">

                    <canvas id="patientStatusChart"></canvas>


                    <div class="doughnut-center">

                        <strong>

                            {{ $totalPatients }}

                        </strong>

                        <span>

                            Pacientes

                        </span>

                    </div>

                </div>



                <div class="chart-legend-custom">


                    <div>

                        <span
                            class="legend-color active-color"
                        ></span>


                        <div>

                            <small>

                                Activos

                            </small>


                            <strong>

                                {{ $activePatients }}

                            </strong>

                        </div>

                    </div>



                    <div>

                        <span
                            class="legend-color inactive-color"
                        ></span>


                        <div>

                            <small>

                                Inactivos

                            </small>


                            <strong>

                                {{ $inactivePatients }}

                            </strong>

                        </div>

                    </div>


                </div>


            </div>


        </div>


    </div>




    {{-- ======================================================
         SEGUNDA FILA DE GRÁFICAS
    ======================================================= --}}

    <div class="secondary-grid">



        {{-- CITAS SEMANA --}}
        <div class="glass-chart-card">


            <div class="chart-header">


                <div>

                    <span class="chart-eyebrow">

                        AGENDA

                    </span>


                    <h4>

                        Citas esta semana

                    </h4>


                    <p>

                        Distribución de consultas
                        por día.

                    </p>

                </div>


                @if(Route::has('citas.index'))

                    <a
                        href="{{ route('citas.index') }}"
                        class="glass-link"
                    >

                        Ver calendario

                        <i class="fas fa-arrow-right"></i>

                    </a>

                @endif


            </div>


            <div class="chart-container medium-chart">

                <canvas id="appointmentsChart"></canvas>

            </div>


        </div>




        {{-- INGRESOS --}}
        <div class="glass-chart-card">


            <div class="chart-header">


                <div>

                    <span class="chart-eyebrow">

                        FINANZAS

                    </span>


                    <h4>

                        Ingresos

                    </h4>


                    <p>

                        Evolución mensual
                        de los ingresos.

                    </p>

                </div>


                <div class="income-total">

                    <small>

                        ESTE MES

                    </small>


                    <strong>

                        ${{ number_format($monthIncome, 0) }}

                    </strong>

                </div>


            </div>


            <div class="chart-container medium-chart">

                <canvas id="incomeChart"></canvas>

            </div>


        </div>


    </div>




    {{-- ======================================================
         PARTE INFERIOR
    ======================================================= --}}

    <div class="bottom-dashboard-grid">



        {{-- RESUMEN --}}
        <div class="summary-glass">


            <div class="section-heading">


                <div>

                    <span>

                        RESUMEN GENERAL

                    </span>


                    <h4>

                        Estado del consultorio

                    </h4>

                </div>


                <div class="section-icon">

                    <i class="fas fa-heartbeat"></i>

                </div>


            </div>



            <div class="summary-list">


                <div class="summary-item">


                    <div class="summary-icon">

                        <i class="fas fa-user-check"></i>

                    </div>


                    <div class="summary-content">

                        <div>

                            <strong>

                                Pacientes activos

                            </strong>

                            <span>

                                {{ $activePatients }}
                                de
                                {{ $totalPatients }}

                            </span>

                        </div>


                        <div class="summary-progress">

                            <div
                                style="width:
                                {{ $activePercentage }}%"
                            ></div>

                        </div>

                    </div>


                    <strong class="summary-percent">

                        {{ $activePercentage }}%

                    </strong>


                </div>



                <div class="summary-item">


                    <div class="summary-icon">

                        <i class="far fa-calendar-check"></i>

                    </div>


                    <div class="summary-content">

                        <div>

                            <strong>

                                Citas mensuales

                            </strong>

                            <span>

                                {{ $monthAppointments }}
                                consultas

                            </span>

                        </div>


                        <div class="summary-progress">

                            <div
                                style="width:
                                {{ min(
                                    $monthAppointments * 5,
                                    100
                                ) }}%"
                            ></div>

                        </div>

                    </div>


                    <strong class="summary-percent">

                        {{ $monthAppointments }}

                    </strong>


                </div>



                <div class="summary-item">


                    <div class="summary-icon">

                        <i class="fas fa-check"></i>

                    </div>


                    <div class="summary-content">

                        <div>

                            <strong>

                                Consultas completadas

                            </strong>

                            <span>

                                Seguimiento del mes

                            </span>

                        </div>


                        <div class="summary-progress">

                            <div
                                style="width:
                                {{ min(
                                    $completedAppointments * 8,
                                    100
                                ) }}%"
                            ></div>

                        </div>

                    </div>


                    <strong class="summary-percent">

                        {{ $completedAppointments }}

                    </strong>


                </div>


            </div>


        </div>




        {{-- ACCESOS RÁPIDOS --}}
        <div class="quick-actions-glass">


            <div class="section-heading">


                <div>

                    <span>

                        ACCESO RÁPIDO

                    </span>


                    <h4>

                        ¿Qué quieres hacer?

                    </h4>

                </div>


                <div class="section-icon">

                    <i class="fas fa-bolt"></i>

                </div>


            </div>



            <div class="quick-actions-grid">


                @if(Route::has('pacientes.create'))

                    <a
                        href="{{ route('pacientes.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">

                            <i class="fas fa-user-plus"></i>

                        </div>

                        <span>

                            Nuevo paciente

                        </span>

                    </a>

                @endif



                @if(Route::has('citas.create'))

                    <a
                        href="{{ route('citas.create') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">

                            <i class="far fa-calendar-plus"></i>

                        </div>

                        <span>

                            Nueva cita

                        </span>

                    </a>

                @endif



                @if(Route::has('pacientes.index'))

                    <a
                        href="{{ route('pacientes.index') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">

                            <i class="fas fa-users"></i>

                        </div>

                        <span>

                            Ver pacientes

                        </span>

                    </a>

                @endif



                @if(Route::has('citas.index'))

                    <a
                        href="{{ route('citas.index') }}"
                        class="quick-action"
                    >

                        <div class="quick-icon">

                            <i class="far fa-calendar-alt"></i>

                        </div>

                        <span>

                            Ver agenda

                        </span>

                    </a>

                @endif


            </div>


        </div>


    </div>




    {{-- ======================================================
         PIE INFORMATIVO
    ======================================================= --}}

    <div class="dashboard-footer-glass">


        <div class="footer-message">


            <div class="footer-leaf">

                <i class="fas fa-seedling"></i>

            </div>


            <div>

                <span>

                    NUTRIADMIN INSIGHT

                </span>


                <p>

                    Mantener actualizados los expedientes
                    y las citas te permitirá tener indicadores
                    más precisos de tu consultorio.

                </p>

            </div>


        </div>


        <div class="system-status">

            <span></span>

            Sistema activo

        </div>


    </div>


</div>

@stop




@section('css')

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

<link
    rel="stylesheet"
    href="{{ asset('css/nutriadmin.css') }}"
>


<style>


/* =========================================================
   GENERAL
========================================================= */

body {

    font-family:
        'Poppins',
        sans-serif;

    background:

        radial-gradient(
            circle at 12% 12%,
            rgba(62, 117, 82, .22),
            transparent 28%
        ),

        radial-gradient(
            circle at 91% 40%,
            rgba(106, 164, 112, .14),
            transparent 28%
        ),

        linear-gradient(
            135deg,
            #08170f 0%,
            #10251a 48%,
            #081810 100%
        ) !important;

    background-attachment:
        fixed !important;

}


.content-wrapper,
.content-header {

    background:
        transparent !important;

}


.nutri-dashboard {

    position: relative;

    min-height: 1000px;

    padding-bottom: 40px;

}



/* =========================================================
   HEADER
========================================================= */

.dashboard-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding-top: 7px;

}


.header-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: #8db398;

    font-size: 9px;

    font-weight: 600;

    letter-spacing: 2px;

}


.dashboard-header h1 {

    margin: 0;

    color: #f4faf5;

    font-size: 30px;

    font-weight: 500;

    letter-spacing: -.7px;

}


.dashboard-header h1 span {

    font-size: 25px;

}


.dashboard-header p {

    margin: 6px 0 0;

    color:
        rgba(220,235,223,.48);

    font-size: 12px;

}


.header-date {

    display: flex;

    align-items: center;

    gap: 11px;

    padding: 10px 15px;

    border-radius: 15px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.045);

    backdrop-filter:
        blur(18px);

}


.date-icon {

    width: 37px;

    height: 37px;

    display: flex;

    justify-content: center;

    align-items: center;

    border-radius: 12px;

    background:
        rgba(143,187,137,.10);

    color: #9fc399;

}


.header-date small {

    display: block;

    color:
        rgba(204,224,208,.35);

    font-size: 7px;

    letter-spacing: 1.3px;

}


.header-date strong {

    display: block;

    margin-top: 2px;

    color:
        rgba(238,247,240,.75);

    font-size: 10px;

    font-weight: 500;

}



/* =========================================================
   AMBIENTE
========================================================= */

.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(100px);

    opacity: .20;

}


.ambient-one {

    width: 340px;

    height: 340px;

    right: 2%;

    top: 150px;

    background: #5d9465;

}


.ambient-two {

    width: 300px;

    height: 300px;

    left: 20%;

    bottom: 0;

    background: #315e43;

}


.ambient-three {

    width: 190px;

    height: 190px;

    left: 3%;

    top: 600px;

    background: #89b67a;

    opacity: .08;

}



/* =========================================================
   HERO
========================================================= */

.dashboard-hero {

    position: relative;

    z-index: 2;

    overflow: hidden;

    min-height: 190px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 32px 40px;

    border-radius: 27px;

    border:
        1px solid rgba(255,255,255,.14);

    background:

        linear-gradient(
            135deg,
            rgba(255,255,255,.105),
            rgba(255,255,255,.025)
        );

    backdrop-filter:
        blur(28px)
        saturate(145%);

    -webkit-backdrop-filter:
        blur(28px)
        saturate(145%);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.17),

        0 25px 55px rgba(0,0,0,.20);

}


.dashboard-hero::before {

    content: "";

    position: absolute;

    width: 500px;

    height: 170px;

    top: -115px;

    left: 12%;

    border-radius: 50%;

    background:
        rgba(255,255,255,.07);

    filter: blur(18px);

}


.hero-left {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    gap: 24px;

}


.hero-icon {

    width: 76px;

    height: 76px;

    min-width: 76px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 23px;

    border:
        1px solid rgba(255,255,255,.18);

    background:

        linear-gradient(
            145deg,
            rgba(173,209,159,.22),
            rgba(255,255,255,.05)
        );

    color: #afd0a3;

    font-size: 28px;

}


.hero-label {

    color: #90b497;

    font-size: 9px;

    letter-spacing: 1.8px;

}


.hero-left h2 {

    margin: 6px 0 8px;

    color: #f3faf5;

    font-size: 32px;

    font-weight: 400;

}


.hero-left h2 span {

    color: #a7cc9a;

    font-weight: 600;

}


.hero-left p {

    max-width: 540px;

    margin: 0;

    color:
        rgba(220,236,223,.52);

    font-size: 12px;

    line-height: 1.7;

}



/* =========================================================
   HEALTH CIRCLE
========================================================= */

.hero-health {

    position: relative;

    width: 210px;

    height: 150px;

}


.health-circle {

    position: absolute;

    right: 25px;

    top: 5px;

    width: 130px;

    height: 130px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    border:
        1px solid rgba(255,255,255,.18);

    background:

        radial-gradient(
            circle,
            rgba(154,200,147,.18),
            rgba(255,255,255,.035)
        );

    backdrop-filter: blur(22px);

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.15),

        0 15px 35px rgba(0,0,0,.13);

}


.health-value {

    color: #ecf7ee;

    font-size: 35px;

    font-weight: 300;

}


.health-value span {

    color: #9ac292;

    font-size: 14px;

}


.health-circle small {

    max-width: 70px;

    text-align: center;

    color:
        rgba(215,232,218,.42);

    font-size: 8px;

    line-height: 1.4;

}


.floating-leaf {

    position: absolute;

    display: flex;

    align-items: center;

    justify-content: center;

    border:
        1px solid rgba(255,255,255,.14);

    background:
        rgba(255,255,255,.055);

    backdrop-filter: blur(14px);

    color: #a4ca99;

}


.leaf-hero-one {

    width: 40px;

    height: 40px;

    left: 5px;

    top: 15px;

    border-radius: 13px;

}


.leaf-hero-two {

    width: 31px;

    height: 31px;

    right: 2px;

    bottom: 4px;

    border-radius: 50%;

}



/* =========================================================
   MÉTRICAS
========================================================= */

.metrics-grid {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0,1fr));

    gap: 15px;

    margin: 18px 0;

}


.metric-card {

    position: relative;

    overflow: hidden;

    padding: 19px;

    min-height: 174px;

    border-radius: 22px;

    border:
        1px solid rgba(255,255,255,.105);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.082),
            rgba(255,255,255,.022)
        );

    backdrop-filter: blur(22px);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.12),

        0 15px 35px rgba(0,0,0,.12);

    transition: .25s;

}


.metric-card:hover {

    transform:
        translateY(-4px);

    border-color:
        rgba(169,208,161,.20);

}


.metric-card::after {

    content: "";

    position: absolute;

    width: 130px;

    height: 130px;

    right: -70px;

    bottom: -75px;

    border-radius: 50%;

    background:
        rgba(139,184,133,.07);

}


.metric-card-top {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 15px;

}


.metric-icon {

    width: 43px;

    height: 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    border:
        1px solid rgba(255,255,255,.08);

    background:
        rgba(146,190,140,.10);

    color: #a3c99a;

}


.appointments-icon {

    color: #aec990;

}


.completed-icon {

    color: #85c2b8;

}


.money-icon {

    color: #d3c17e;

}


.metric-growth {

    display: inline-flex;

    align-items: center;

    gap: 4px;

    padding: 5px 8px;

    border-radius: 20px;

    font-size: 8px;

}


.metric-growth.positive {

    color: #9bd2a3;

    background:
        rgba(90,169,103,.08);

}


.metric-growth.negative {

    color: #d98a8a;

    background:
        rgba(187,75,75,.08);

}


.metric-mini {

    color:
        rgba(207,225,211,.30);

    font-size: 7px;

    letter-spacing: 1.2px;

}


.metric-label {

    position: relative;

    z-index: 2;

    display: block;

    color:
        rgba(218,234,221,.42);

    font-size: 9px;

}


.metric-card h3 {

    position: relative;

    z-index: 2;

    margin: 4px 0;

    color: #f1f9f3;

    font-size: 28px;

    font-weight: 500;

}


.metric-card h3.money-value {

    font-size: 25px;

}


.metric-footer {

    position: relative;

    z-index: 2;

    display: flex;

    justify-content: space-between;

    margin-top: 8px;

    color:
        rgba(214,231,217,.34);

    font-size: 8px;

}


.metric-footer strong {

    color: #9fc298;

    font-weight: 500;

}


.metric-progress {

    position: relative;

    z-index: 2;

    overflow: hidden;

    height: 4px;

    margin-top: 11px;

    border-radius: 5px;

    background:
        rgba(255,255,255,.055);

}


.metric-progress-value {

    height: 100%;

    border-radius: 5px;

    background:

        linear-gradient(
            90deg,
            #719d72,
            #a8ca9c
        );

}


.appointment-progress {

    background:

        linear-gradient(
            90deg,
            #809e64,
            #c0d293
        );

}


.completed-progress {

    background:

        linear-gradient(
            90deg,
            #5c9490,
            #98c9c3
        );

}


.money-progress {

    background:

        linear-gradient(
            90deg,
            #a28b54,
            #dbcb8e
        );

}



/* =========================================================
   CHART CARDS
========================================================= */

.main-charts-grid {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        1.6fr
        .75fr;

    gap: 18px;

    margin-bottom: 18px;

}


.secondary-grid {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        1fr
        1fr;

    gap: 18px;

    margin-bottom: 18px;

}


.glass-chart-card {

    position: relative;

    overflow: hidden;

    padding: 24px;

    border-radius: 25px;

    border:
        1px solid rgba(255,255,255,.105);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.075),
            rgba(255,255,255,.02)
        );

    backdrop-filter:
        blur(24px)
        saturate(135%);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.12),

        0 18px 40px rgba(0,0,0,.13);

}


.glass-chart-card::before {

    content: "";

    position: absolute;

    width: 220px;

    height: 90px;

    top: -70px;

    left: 20%;

    border-radius: 50%;

    background:
        rgba(255,255,255,.045);

    filter: blur(15px);

}


.chart-header {

    position: relative;

    z-index: 2;

    display: flex;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 20px;

}


.chart-eyebrow {

    display: block;

    margin-bottom: 4px;

    color:
        rgba(180,209,185,.38);

    font-size: 8px;

    letter-spacing: 1.5px;

}


.chart-header h4 {

    margin: 0;

    color: #eef7f0;

    font-size: 17px;

    font-weight: 500;

}


.chart-header p {

    margin: 5px 0 0;

    color:
        rgba(211,230,215,.37);

    font-size: 8px;

}


.chart-badge,
.glass-link {

    align-self: flex-start;

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 10px;

    border-radius: 11px;

    border:
        1px solid rgba(255,255,255,.08);

    background:
        rgba(255,255,255,.035);

    color:
        rgba(201,224,205,.43);

    font-size: 8px;

}


.glass-link {

    color: #98bd94 !important;

    text-decoration: none !important;

    transition: .2s;

}


.glass-link:hover {

    background:
        rgba(143,188,137,.12);

    color: #b8d7b1 !important;

}


.chart-container {

    position: relative;

    width: 100%;

}


.large-chart {

    height: 270px;

}


.medium-chart {

    height: 235px;

}



/* =========================================================
   DOUGHNUT
========================================================= */

.doughnut-wrapper {

    display: flex;

    align-items: center;

    justify-content: center;

    flex-direction: column;

}


.doughnut-container {

    position: relative;

    width: 190px;

    height: 190px;

}


.doughnut-center {

    position: absolute;

    inset: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-direction: column;

    pointer-events: none;

}


.doughnut-center strong {

    color: #f0f8f2;

    font-size: 30px;

    font-weight: 500;

}


.doughnut-center span {

    color:
        rgba(210,228,214,.38);

    font-size: 8px;

}


.chart-legend-custom {

    width: 100%;

    display: grid;

    grid-template-columns:
        1fr
        1fr;

    gap: 8px;

    margin-top: 18px;

}


.chart-legend-custom > div {

    display: flex;

    align-items: center;

    gap: 8px;

    padding: 9px;

    border-radius: 13px;

    background:
        rgba(255,255,255,.03);

    border:
        1px solid rgba(255,255,255,.055);

}


.legend-color {

    width: 9px;

    height: 9px;

    border-radius: 50%;

}


.active-color {

    background: #9cc799;

    box-shadow:
        0 0 8px
        rgba(156,199,153,.35);

}


.inactive-color {

    background: #405849;

}


.chart-legend-custom small {

    display: block;

    color:
        rgba(213,230,217,.33);

    font-size: 7px;

}


.chart-legend-custom strong {

    display: block;

    margin-top: 1px;

    color: #eaf5ec;

    font-size: 11px;

}



/* =========================================================
   INCOME
========================================================= */

.income-total {

    text-align: right;

}


.income-total small {

    display: block;

    color:
        rgba(209,227,213,.28);

    font-size: 7px;

    letter-spacing: 1px;

}


.income-total strong {

    display: block;

    margin-top: 2px;

    color: #d6ca95;

    font-size: 16px;

    font-weight: 500;

}



/* =========================================================
   BOTTOM
========================================================= */

.bottom-dashboard-grid {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        1.3fr
        .7fr;

    gap: 18px;

    margin-bottom: 18px;

}


.summary-glass,
.quick-actions-glass {

    padding: 23px;

    border-radius: 24px;

    border:
        1px solid rgba(255,255,255,.10);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.07),
            rgba(255,255,255,.018)
        );

    backdrop-filter: blur(22px);

    box-shadow:
        0 16px 35px rgba(0,0,0,.11);

}


.section-heading {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 17px;

}


.section-heading span {

    display: block;

    color:
        rgba(190,214,194,.32);

    font-size: 7px;

    letter-spacing: 1.4px;

}


.section-heading h4 {

    margin: 3px 0 0;

    color: #eef7f0;

    font-size: 16px;

}


.section-icon {

    width: 38px;

    height: 38px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(142,186,137,.09);

    color: #9fc298;

}



/* =========================================================
   SUMMARY
========================================================= */

.summary-item {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 14px 0;

    border-top:
        1px solid rgba(255,255,255,.05);

}


.summary-icon {

    width: 39px;

    height: 39px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(143,188,137,.08);

    color: #97bc92;

}


.summary-content {

    flex: 1;

}


.summary-content > div:first-child {

    display: flex;

    align-items: center;

    justify-content: space-between;

}


.summary-content strong {

    color:
        rgba(235,245,237,.72);

    font-size: 9px;

    font-weight: 500;

}


.summary-content span {

    color:
        rgba(208,226,212,.31);

    font-size: 7px;

}


.summary-progress {

    overflow: hidden;

    height: 3px;

    margin-top: 8px;

    border-radius: 4px;

    background:
        rgba(255,255,255,.045);

}


.summary-progress div {

    height: 100%;

    border-radius: 4px;

    background:

        linear-gradient(
            90deg,
            #709c70,
            #a7ca9c
        );

}


.summary-percent {

    min-width: 45px;

    text-align: right;

    color: #9fc198;

    font-size: 10px;

}



/* =========================================================
   QUICK ACTIONS
========================================================= */

.quick-actions-grid {

    display: grid;

    grid-template-columns:
        1fr
        1fr;

    gap: 10px;

}


.quick-action {

    min-height: 98px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-direction: column;

    gap: 8px;

    border-radius: 17px;

    border:
        1px solid rgba(255,255,255,.07);

    background:
        rgba(255,255,255,.028);

    color:
        rgba(222,237,225,.58) !important;

    font-size: 8px;

    text-decoration: none !important;

    transition: .24s;

}


.quick-icon {

    width: 38px;

    height: 38px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(140,186,135,.09);

    color: #9ec297;

    font-size: 13px;

}


.quick-action:hover {

    transform:
        translateY(-3px);

    border-color:
        rgba(169,208,161,.18);

    background:
        rgba(143,188,137,.09);

    color: #e7f4e9 !important;

}



/* =========================================================
   FOOTER
========================================================= */

.dashboard-footer-glass {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding: 17px 20px;

    border-radius: 19px;

    border:
        1px solid rgba(255,255,255,.08);

    background:
        rgba(255,255,255,.026);

    backdrop-filter: blur(18px);

}


.footer-message {

    display: flex;

    align-items: center;

    gap: 12px;

}


.footer-leaf {

    width: 38px;

    height: 38px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(142,187,137,.09);

    color: #9bc195;

}


.footer-message span {

    display: block;

    margin-bottom: 2px;

    color:
        rgba(175,207,180,.35);

    font-size: 7px;

    letter-spacing: 1.4px;

}


.footer-message p {

    margin: 0;

    color:
        rgba(211,229,215,.37);

    font-size: 8px;

}


.system-status {

    display: flex;

    align-items: center;

    gap: 6px;

    white-space: nowrap;

    color:
        rgba(210,229,214,.37);

    font-size: 8px;

}


.system-status span {

    width: 6px;

    height: 6px;

    border-radius: 50%;

    background: #87cb91;

    box-shadow:
        0 0 8px
        rgba(135,203,145,.55);

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 1200px) {

    .metrics-grid {

        grid-template-columns:
            repeat(2,1fr);

    }


    .main-charts-grid {

        grid-template-columns:
            1fr;

    }

}


@media(max-width: 900px) {

    .secondary-grid,
    .bottom-dashboard-grid {

        grid-template-columns:
            1fr;

    }

}


@media(max-width: 767px) {

    .dashboard-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .header-date {

        display: none;

    }


    .dashboard-hero {

        padding: 26px 22px;

    }


    .hero-health {

        display: none;

    }


    .hero-left {

        align-items: flex-start;

    }


    .hero-icon {

        width: 58px;

        min-width: 58px;

        height: 58px;

        border-radius: 18px;

        font-size: 21px;

    }


    .hero-left h2 {

        font-size: 25px;

    }


    .metrics-grid {

        grid-template-columns:
            1fr
            1fr;

    }


    .glass-chart-card {

        padding: 18px;

    }


    .chart-header {

        flex-direction: column;

    }


    .chart-badge,
    .glass-link {

        align-self: flex-start;

    }

}


@media(max-width: 520px) {

    .metrics-grid {

        grid-template-columns:
            1fr;

    }


    .quick-actions-grid {

        grid-template-columns:
            1fr
            1fr;

    }


    .dashboard-footer-glass {

        align-items: flex-start;

        flex-direction: column;

    }


    .large-chart,
    .medium-chart {

        height: 220px;

    }

}

</style>

@stop




@section('js')

<script
    src="https://cdn.jsdelivr.net/npm/chart.js"
></script>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


    /* =====================================================
       COLORES GENERALES
    ===================================================== */

    const gridColor =
        'rgba(255,255,255,0.045)';

    const labelColor =
        'rgba(216,234,220,0.38)';

    const green =
        '#9fc99a';

    const greenDark =
        '#56785d';


    Chart.defaults.color =
        labelColor;

    Chart.defaults.font.family =
        'Poppins';




    /* =====================================================
       PACIENTES - CRECIMIENTO
    ===================================================== */

    const patientsCanvas =
        document.getElementById(
            'patientsGrowthChart'
        );


    if (patientsCanvas) {


        const ctx =
            patientsCanvas
                .getContext('2d');


        const gradient =
            ctx.createLinearGradient(
                0,
                0,
                0,
                280
            );


        gradient.addColorStop(
            0,
            'rgba(159,201,154,.28)'
        );

        gradient.addColorStop(
            1,
            'rgba(159,201,154,0)'
        );


        new Chart(
            patientsCanvas,
            {

                type: 'line',

                data: {

                    labels:
                        @json($patientChartLabels),

                    datasets: [

                        {

                            data:
                                @json($patientChartData),

                            borderColor:
                                green,

                            backgroundColor:
                                gradient,

                            fill:
                                true,

                            borderWidth:
                                2,

                            tension:
                                .42,

                            pointRadius:
                                0,

                            pointHoverRadius:
                                5,

                            pointHoverBackgroundColor:
                                green,

                            pointHoverBorderColor:
                                '#13251a',

                            pointHoverBorderWidth:
                                3

                        }

                    ]

                },


                options: {

                    responsive:
                        true,

                    maintainAspectRatio:
                        false,

                    interaction: {

                        intersect:
                            false,

                        mode:
                            'index'

                    },

                    plugins: {

                        legend: {

                            display:
                                false

                        },

                        tooltip: {

                            backgroundColor:
                                'rgba(16,37,26,.95)',

                            borderColor:
                                'rgba(255,255,255,.10)',

                            borderWidth:
                                1,

                            padding:
                                10,

                            displayColors:
                                false

                        }

                    },

                    scales: {

                        x: {

                            border: {

                                display:
                                    false

                            },

                            grid: {

                                display:
                                    false

                            },

                            ticks: {

                                color:
                                    labelColor,

                                font: {

                                    size:
                                        9

                                }

                            }

                        },

                        y: {

                            beginAtZero:
                                true,

                            border: {

                                display:
                                    false

                            },

                            grid: {

                                color:
                                    gridColor

                            },

                            ticks: {

                                color:
                                    labelColor,

                                precision:
                                    0,

                                font: {

                                    size:
                                        8

                                }

                            }

                        }

                    }

                }

            }
        );

    }




    /* =====================================================
       PACIENTES ACTIVOS / INACTIVOS
    ===================================================== */

    const statusCanvas =
        document.getElementById(
            'patientStatusChart'
        );


    if (statusCanvas) {


        new Chart(
            statusCanvas,
            {

                type: 'doughnut',

                data: {

                    labels: [

                        'Activos',
                        'Inactivos'

                    ],

                    datasets: [

                        {

                            data: [

                                {{ $activePatients }},
                                {{ $inactivePatients }}

                            ],

                            backgroundColor: [

                                '#9fc99a',
                                '#405849'

                            ],

                            borderColor: [

                                'rgba(255,255,255,.06)',
                                'rgba(255,255,255,.04)'

                            ],

                            borderWidth:
                                1,

                            hoverOffset:
                                4

                        }

                    ]

                },


                options: {

                    responsive:
                        true,

                    maintainAspectRatio:
                        false,

                    cutout:
                        '77%',

                    plugins: {

                        legend: {

                            display:
                                false

                        },

                        tooltip: {

                            backgroundColor:
                                'rgba(16,37,26,.95)',

                            borderColor:
                                'rgba(255,255,255,.10)',

                            borderWidth:
                                1,

                            padding:
                                9

                        }

                    }

                }

            }
        );

    }




    /* =====================================================
       CITAS
    ===================================================== */

    const appointmentsCanvas =
        document.getElementById(
            'appointmentsChart'
        );


    if (appointmentsCanvas) {


        new Chart(
            appointmentsCanvas,
            {

                type:
                    'bar',

                data: {

                    labels:
                        @json($appointmentChartLabels),

                    datasets: [

                        {

                            data:
                                @json($appointmentChartData),

                            backgroundColor:
                                'rgba(157,196,147,.55)',

                            hoverBackgroundColor:
                                '#a9cc9f',

                            borderRadius:
                                8,

                            borderSkipped:
                                false,

                            barThickness:
                                17

                        }

                    ]

                },


                options: {

                    responsive:
                        true,

                    maintainAspectRatio:
                        false,

                    plugins: {

                        legend: {

                            display:
                                false

                        },

                        tooltip: {

                            backgroundColor:
                                'rgba(16,37,26,.95)',

                            displayColors:
                                false

                        }

                    },

                    scales: {

                        x: {

                            border: {

                                display:
                                    false

                            },

                            grid: {

                                display:
                                    false

                            },

                            ticks: {

                                color:
                                    labelColor,

                                font: {

                                    size:
                                        8

                                }

                            }

                        },

                        y: {

                            beginAtZero:
                                true,

                            border: {

                                display:
                                    false

                            },

                            grid: {

                                color:
                                    gridColor

                            },

                            ticks: {

                                precision:
                                    0,

                                color:
                                    labelColor,

                                font: {

                                    size:
                                        8

                                }

                            }

                        }

                    }

                }

            }
        );

    }




    /* =====================================================
       INGRESOS
    ===================================================== */

    const incomeCanvas =
        document.getElementById(
            'incomeChart'
        );


    if (incomeCanvas) {


        const ctx =
            incomeCanvas
                .getContext('2d');


        const incomeGradient =
            ctx.createLinearGradient(
                0,
                0,
                0,
                250
            );


        incomeGradient.addColorStop(
            0,
            'rgba(213,194,126,.25)'
        );

        incomeGradient.addColorStop(
            1,
            'rgba(213,194,126,0)'
        );


        new Chart(
            incomeCanvas,
            {

                type:
                    'line',

                data: {

                    labels:
                        @json($incomeChartLabels),

                    datasets: [

                        {

                            data:
                                @json($incomeChartData),

                            borderColor:
                                '#d5c27e',

                            backgroundColor:
                                incomeGradient,

                            fill:
                                true,

                            borderWidth:
                                2,

                            tension:
                                .42,

                            pointRadius:
                                0,

                            pointHoverRadius:
                                4

                        }

                    ]

                },


                options: {

                    responsive:
                        true,

                    maintainAspectRatio:
                        false,

                    plugins: {

                        legend: {

                            display:
                                false

                        },

                        tooltip: {

                            backgroundColor:
                                'rgba(16,37,26,.95)',

                            displayColors:
                                false,

                            callbacks: {

                                label:
                                    function(context) {

                                        return '$' +
                                            Number(
                                                context.raw
                                            )
                                            .toLocaleString(
                                                'es-MX'
                                            );

                                    }

                            }

                        }

                    },

                    scales: {

                        x: {

                            border: {

                                display:
                                    false

                            },

                            grid: {

                                display:
                                    false

                            },

                            ticks: {

                                color:
                                    labelColor,

                                font: {

                                    size:
                                        8

                                }

                            }

                        },

                        y: {

                            beginAtZero:
                                true,

                            border: {

                                display:
                                    false

                            },

                            grid: {

                                color:
                                    gridColor

                            },

                            ticks: {

                                color:
                                    labelColor,

                                font: {

                                    size:
                                        8

                                },

                                callback:
                                    function(value) {

                                        return '$' +
                                            value;

                                    }

                            }

                        }

                    }

                }

            }
        );

    }


});

</script>

@stop