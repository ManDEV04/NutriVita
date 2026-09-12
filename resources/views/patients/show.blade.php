@extends('adminlte::page')

@section('title', 'Paciente | NutriAdmin')


@section('content_header')

<div class="patient-show-header">

    <div>

        <span class="header-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            EXPEDIENTE · NUTRIADMIN
        </span>

        <h1>
            {{ $paciente->first_name }}
            {{ $paciente->last_name }}
        </h1>

        <p>
            Perfil, evaluaciones y progreso nutricional.
        </p>

    </div>


    <div class="header-actions">

        <a
            href="{{ route('pacientes.index') }}"
            class="btn-liquid-secondary"
        >
            <i class="fas fa-arrow-left"></i>
            Regresar
        </a>


        <a
            href="{{ route('pacientes.edit', $paciente) }}"
            class="btn-liquid-primary"
        >
            <i class="far fa-edit"></i>
            Editar paciente
        </a>

    </div>

</div>

@stop



@section('content')

<div class="patient-show-page">


    {{-- LUCES --}}
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>
    <div class="ambient ambient-three"></div>


    {{-- MENSAJE --}}
    @if(session('success'))

        <div class="glass-alert">

            <div class="glass-alert-icon">
                <i class="fas fa-check"></i>
            </div>

            <div>
                <strong>Actualización completada</strong>
                <span>{{ session('success') }}</span>
            </div>

        </div>

    @endif



    {{-- =====================================================
         HERO DEL PACIENTE
    ====================================================== --}}

    <div class="patient-hero-glass">


        <div class="patient-hero-main">


            <div class="hero-avatar">

                {{ strtoupper(substr($paciente->first_name, 0, 1)) }}
                {{ strtoupper(substr($paciente->last_name, 0, 1)) }}

            </div>


            <div class="hero-patient-info">

                <span class="hero-eyebrow">
                    EXPEDIENTE DEL PACIENTE
                </span>


                <h2>

                    {{ $paciente->first_name }}
                    {{ $paciente->last_name }}

                </h2>


                <p>

                    <i class="fas fa-briefcase"></i>

                    {{ $paciente->occupation ?? 'Sin ocupación registrada' }}

                </p>


                <div class="hero-badges">

                    @if($paciente->active)

                        <span class="status-badge active">

                            <span></span>

                            Paciente activo

                        </span>

                    @else

                        <span class="status-badge inactive">

                            <span></span>

                            Paciente inactivo

                        </span>

                    @endif


                    @if($paciente->sex)

                        <span class="soft-badge">

                            <i class="fas fa-venus-mars"></i>

                            {{ $paciente->sex }}

                        </span>

                    @endif


                    @if($paciente->birth_date)

                        <span class="soft-badge">

                            <i class="far fa-calendar"></i>

                            {{ $paciente->birth_date->age }} años

                        </span>

                    @endif

                </div>

            </div>

        </div>



        <div class="hero-summary">


            <div class="summary-mini">

                <span>
                    EVALUACIONES
                </span>

                <strong>
                    {{ $evaluations->count() }}
                </strong>

            </div>


            <div class="summary-mini">

                <span>
                    REGISTRO
                </span>

                <strong>
                    {{ $paciente->created_at->format('d/m/Y') }}
                </strong>

            </div>


            <div class="hero-decoration">

                <i class="fas fa-seedling"></i>

            </div>

        </div>


    </div>



    {{-- =====================================================
         GRID SUPERIOR
    ====================================================== --}}

    <div class="top-grid">


        {{-- COLUMNA IZQUIERDA --}}
        <div class="left-column">


            {{-- CONTACTO --}}
            <div class="glass-card">


                <div class="card-heading">

                    <div>

                        <span>
                            CONTACTO
                        </span>

                        <h4>
                            Información de contacto
                        </h4>

                    </div>


                    <div class="heading-icon">

                        <i class="far fa-address-card"></i>

                    </div>

                </div>


                <div class="contact-list">


                    <div class="contact-item">

                        <div class="contact-icon">

                            <i class="fas fa-phone-alt"></i>

                        </div>

                        <div>

                            <span>
                                Teléfono
                            </span>

                            <strong>
                                {{ $paciente->phone ?? 'Sin teléfono' }}
                            </strong>

                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">

                            <i class="far fa-envelope"></i>

                        </div>

                        <div>

                            <span>
                                Correo electrónico
                            </span>

                            <strong>
                                {{ $paciente->email ?? 'Sin correo' }}
                            </strong>

                        </div>

                    </div>


                </div>

            </div>



            {{-- OBJETIVO --}}
            <div class="goal-glass">


                <div class="goal-icon">

                    <i class="fas fa-bullseye"></i>

                </div>


                <span class="goal-label">
                    OBJETIVO NUTRICIONAL
                </span>


                <h4>
                    Meta del paciente
                </h4>


                <p>

                    {{ $paciente->goal
                        ?? 'No se ha registrado un objetivo nutricional.' }}

                </p>

            </div>



            {{-- INFO PRIVADA --}}
            <div class="privacy-glass">

                <div>

                    <i class="fas fa-shield-alt"></i>

                </div>

                <p>

                    <strong>
                        Expediente privado
                    </strong>

                    La información de este paciente está vinculada
                    a tu cuenta de NutriAdmin.

                </p>

            </div>


        </div>



        {{-- COLUMNA DERECHA --}}
        <div class="right-column">


            {{-- INFORMACIÓN GENERAL --}}
            <div class="glass-card">


                <div class="card-heading">

                    <div>

                        <span>
                            INFORMACIÓN GENERAL
                        </span>

                        <h4>
                            Datos del paciente
                        </h4>

                    </div>


                    <div class="heading-icon">

                        <i class="far fa-user"></i>

                    </div>

                </div>



                <div class="general-info-grid">


                    <div class="general-info-item">

                        <div class="info-icon">

                            <i class="far fa-calendar-alt"></i>

                        </div>

                        <div>

                            <span>
                                Fecha de nacimiento
                            </span>

                            <strong>

                                {{ $paciente->birth_date
                                    ? $paciente->birth_date->format('d/m/Y')
                                    : 'No registrada'
                                }}

                            </strong>

                        </div>

                    </div>



                    <div class="general-info-item">

                        <div class="info-icon">

                            <i class="fas fa-birthday-cake"></i>

                        </div>

                        <div>

                            <span>
                                Edad
                            </span>

                            <strong>

                                {{ $paciente->birth_date
                                    ? $paciente->birth_date->age . ' años'
                                    : '—'
                                }}

                            </strong>

                        </div>

                    </div>



                    <div class="general-info-item">

                        <div class="info-icon">

                            <i class="fas fa-venus-mars"></i>

                        </div>

                        <div>

                            <span>
                                Sexo
                            </span>

                            <strong>

                                {{ $paciente->sex ?? 'No registrado' }}

                            </strong>

                        </div>

                    </div>



                    <div class="general-info-item">

                        <div class="info-icon">

                            <i class="fas fa-briefcase"></i>

                        </div>

                        <div>

                            <span>
                                Ocupación
                            </span>

                            <strong>

                                {{ $paciente->occupation ?? 'No registrada' }}

                            </strong>

                        </div>

                    </div>



                    <div class="general-info-item">

                        <div class="info-icon">

                            <i class="fas fa-user-plus"></i>

                        </div>

                        <div>

                            <span>
                                Fecha de registro
                            </span>

                            <strong>

                                {{ $paciente->created_at->format('d/m/Y') }}

                            </strong>

                        </div>

                    </div>



                    <div class="general-info-item">

                        <div class="info-icon">

                            <i class="fas fa-clipboard-check"></i>

                        </div>

                        <div>

                            <span>
                                Evaluaciones
                            </span>

                            <strong>

                                {{ $evaluations->count() }}

                            </strong>

                        </div>

                    </div>


                </div>

            </div>


        </div>

    </div>



    {{-- =====================================================
         ÚLTIMA EVALUACIÓN
    ====================================================== --}}

    @if($latestEvaluation)


        <div class="evaluation-glass">


            <div class="evaluation-header">


                <div>

                    <span class="section-eyebrow">

                        ÚLTIMA EVALUACIÓN

                    </span>


                    <h3>
                        Estado corporal actual
                    </h3>


                    <p>

                        Evaluación realizada el

                        {{ $latestEvaluation
                            ->evaluation_date
                            ->format('d/m/Y')
                        }}

                    </p>

                </div>


                <div class="evaluation-badge">

                    <i class="fas fa-clipboard-check"></i>

                    Evaluación #{{ $evaluations->count() }}

                </div>

            </div>



            <div class="evaluation-metrics">


                {{-- PESO --}}
                <div class="metric-glass">


                    <div class="metric-icon">

                        <i class="fas fa-weight"></i>

                    </div>


                    <span>
                        PESO
                    </span>


                    <h3>

                        {{ $latestEvaluation->weight }}

                        <small>
                            kg
                        </small>

                    </h3>


                </div>



                {{-- IMC --}}
                <div class="metric-glass">


                    <div class="metric-icon">

                        <i class="fas fa-calculator"></i>

                    </div>


                    <span>
                        IMC
                    </span>


                    <h3>

                        {{ $latestEvaluation->bmi }}

                    </h3>


                </div>



                {{-- GRASA --}}
                <div class="metric-glass">


                    <div class="metric-icon">

                        <i class="fas fa-percentage"></i>

                    </div>


                    <span>
                        GRASA CORPORAL
                    </span>


                    <h3>

                        {{ $latestEvaluation->body_fat ?? '—' }}

                        @if(!is_null($latestEvaluation->body_fat))

                            <small>
                                %
                            </small>

                        @endif

                    </h3>


                </div>



                {{-- MÚSCULO --}}
                <div class="metric-glass">


                    <div class="metric-icon">

                        <i class="fas fa-dumbbell"></i>

                    </div>


                    <span>
                        MASA MUSCULAR
                    </span>


                    <h3>

                        {{ $latestEvaluation->muscle_mass ?? '—' }}

                        @if(!is_null($latestEvaluation->muscle_mass))

                            <small>
                                kg
                            </small>

                        @endif

                    </h3>


                </div>


            </div>

        </div>


    @else


        {{-- SIN EVALUACIONES --}}
        <div class="empty-evaluation-glass">


            <div class="empty-evaluation-icon">

                <i class="fas fa-clipboard"></i>

            </div>


            <span>
                SEGUIMIENTO NUTRICIONAL
            </span>


            <h3>
                Aún no hay evaluaciones
            </h3>


            <p>

                Registra la primera evaluación para comenzar
                a medir peso, IMC, grasa corporal y progreso.

            </p>


            <a
                href="{{ route('evaluaciones.create', $paciente) }}"
                class="btn-liquid-primary"
            >

                <i class="fas fa-plus"></i>

                Primera evaluación

            </a>


        </div>


    @endif



    {{-- =====================================================
         PROGRESO
    ====================================================== --}}

    @if($firstEvaluation && $currentEvaluation)


        <div class="progress-section">


            <div class="section-title-row">


                <div>

                    <span class="section-eyebrow">

                        PROGRESO

                    </span>


                    <h3>
                        Cambios desde la primera evaluación
                    </h3>

                </div>


                <div class="section-small-icon">

                    <i class="fas fa-chart-line"></i>

                </div>

            </div>



            <div class="progress-grid">


                {{-- PESO INICIAL --}}
                <div class="progress-glass-card">


                    <span>
                        PESO INICIAL
                    </span>


                    <h3>

                        {{ $firstEvaluation->weight }}

                        <small>
                            kg
                        </small>

                    </h3>


                    <p>
                        Primera evaluación
                    </p>


                </div>



                {{-- PESO ACTUAL --}}
                <div class="progress-glass-card">


                    <span>
                        PESO ACTUAL
                    </span>


                    <h3>

                        {{ $currentEvaluation->weight }}

                        <small>
                            kg
                        </small>

                    </h3>


                    <p>
                        Última evaluación
                    </p>


                </div>



                {{-- CAMBIO PESO --}}
                <div class="progress-glass-card">


                    <span>
                        CAMBIO DE PESO
                    </span>


                    <h3>

                        @if($weightChange !== null)

                            @if($weightChange > 0)
                                +
                            @endif

                            {{ $weightChange }}

                            <small>
                                kg
                            </small>

                        @else

                            —

                        @endif

                    </h3>


                    @if($weightChange !== null)

                        @if($weightChange < 0)

                            <p class="progress-positive">

                                <i class="fas fa-arrow-down"></i>

                                {{ abs($weightChange) }} kg

                            </p>

                        @elseif($weightChange > 0)

                            <p class="progress-warning">

                                <i class="fas fa-arrow-up"></i>

                                {{ $weightChange }} kg

                            </p>

                        @else

                            <p>
                                Sin cambios
                            </p>

                        @endif

                    @endif


                </div>



                {{-- CAMBIO GRASA --}}
                <div class="progress-glass-card">


                    <span>
                        CAMBIO DE GRASA
                    </span>


                    <h3>

                        @if($fatChange !== null)

                            @if($fatChange > 0)
                                +
                            @endif

                            {{ $fatChange }}

                            <small>
                                %
                            </small>

                        @else

                            —

                        @endif

                    </h3>


                    <p>
                        Desde el inicio
                    </p>


                </div>


            </div>


        </div>


    @endif



    {{-- =====================================================
         GRÁFICA
    ====================================================== --}}

    @if($showWeightChart)


        <div class="weight-chart-glass">


            <div class="chart-header">


                <div>

                    <span class="section-eyebrow">

                        EVOLUCIÓN

                    </span>


                    <h3>

                        Evolución del peso

                    </h3>


                    <p>

                        Seguimiento del peso a través
                        de las evaluaciones registradas.

                    </p>

                </div>


                <div class="chart-icon">

                    <i class="fas fa-chart-line"></i>

                </div>


            </div>


            <div class="chart-wrapper">

                <canvas id="weightChart"></canvas>

            </div>


        </div>


    @elseif($evaluations->count() === 1)


        <div class="chart-waiting-glass">


            <div>

                <i class="fas fa-chart-line"></i>

            </div>


            <span>
                EVOLUCIÓN
            </span>


            <h4>
                La gráfica estará disponible pronto
            </h4>


            <p>

                Registra una segunda evaluación para
                comenzar a visualizar la evolución del peso.

            </p>


        </div>


    @endif



    {{-- =====================================================
         HISTORIAL
    ====================================================== --}}

    <div class="history-glass">


        <div class="history-header">


            <div>

                <span class="section-eyebrow">

                    HISTORIAL

                </span>


                <h3>
                    Evaluaciones nutricionales
                </h3>


                <p>

                    Consulta todas las mediciones registradas
                    para este paciente.

                </p>

            </div>


            <a
                href="{{ route('evaluaciones.create', $paciente) }}"
                class="btn-liquid-primary"
            >

                <i class="fas fa-plus"></i>

                Nueva evaluación

            </a>


        </div>



        @if($evaluations->isEmpty())


            <div class="empty-history">

                <i class="far fa-clipboard"></i>

                <p>
                    Aún no hay evaluaciones registradas.
                </p>

            </div>


        @else


            <div class="table-responsive">


                <table class="liquid-table">


                    <thead>

                        <tr>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Peso
                            </th>

                            <th>
                                IMC
                            </th>

                            <th>
                                Grasa
                            </th>

                            <th>
                                Músculo
                            </th>

                            <th>
                                Cintura
                            </th>

                        </tr>

                    </thead>



                    <tbody>

                    @foreach($evaluations as $evaluation)

                        <tr>


                            <td>

                                <div class="table-date">

                                    <div>

                                        {{ $evaluation
                                            ->evaluation_date
                                            ->format('d')
                                        }}

                                    </div>

                                    <span>

                                        {{ strtoupper(
                                            $evaluation
                                            ->evaluation_date
                                            ->translatedFormat('M')
                                        ) }}

                                    </span>

                                </div>

                            </td>


                            <td>

                                <strong>

                                    {{ $evaluation->weight }}

                                </strong>

                                <small>
                                    kg
                                </small>

                            </td>


                            <td>

                                {{ $evaluation->bmi }}

                            </td>


                            <td>

                                {{ $evaluation->body_fat !== null
                                    ? $evaluation->body_fat . ' %'
                                    : '—'
                                }}

                            </td>


                            <td>

                                {{ $evaluation->muscle_mass !== null
                                    ? $evaluation->muscle_mass . ' kg'
                                    : '—'
                                }}

                            </td>


                            <td>

                                {{ $evaluation->waist !== null
                                    ? $evaluation->waist . ' cm'
                                    : '—'
                                }}

                            </td>


                        </tr>

                    @endforeach

                    </tbody>


                </table>


            </div>


        @endif


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

    font-family: 'Poppins', sans-serif;

    background:

        radial-gradient(
            circle at 12% 12%,
            rgba(62,117,82,.22),
            transparent 28%
        ),

        radial-gradient(
            circle at 92% 42%,
            rgba(103,162,111,.14),
            transparent 28%
        ),

        linear-gradient(
            135deg,
            #08170f 0%,
            #10251a 48%,
            #081810 100%
        ) !important;

    background-attachment: fixed !important;

}


.content-wrapper,
.content-header {

    background: transparent !important;

}


.patient-show-page {

    position: relative;

    min-height: 1000px;

    padding-bottom: 45px;

}



/* =========================================================
   HEADER
========================================================= */

.patient-show-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

}


.header-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: #8fb59a;

    font-size: 9px;

    font-weight: 600;

    letter-spacing: 2px;

}


.patient-show-header h1 {

    margin: 0;

    color: #f4faf5;

    font-size: 30px;

    font-weight: 500;

}


.patient-show-header p {

    margin: 6px 0 0;

    color: rgba(217,233,220,.45);

    font-size: 11px;

}


.header-actions {

    display: flex;

    gap: 8px;

}



/* =========================================================
   BOTONES
========================================================= */

.btn-liquid-primary,
.btn-liquid-secondary {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    height: 43px;

    padding: 0 15px;

    border-radius: 14px;

    text-decoration: none !important;

    font-size: 9px;

    transition: .22s;

}


.btn-liquid-primary {

    border: 1px solid rgba(255,255,255,.20);

    background:

        linear-gradient(
            135deg,
            #abd0a0,
            #76a777
        );

    color: #102318 !important;

    font-weight: 600;

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.50),

        0 12px 28px rgba(69,135,83,.18);

}


.btn-liquid-primary:hover {

    transform: translateY(-2px);

}


.btn-liquid-secondary {

    border: 1px solid rgba(255,255,255,.09);

    background: rgba(255,255,255,.035);

    color: rgba(225,239,228,.55) !important;

}


.btn-liquid-secondary:hover {

    transform: translateY(-2px);

    color: #edf7ef !important;

    background: rgba(255,255,255,.065);

}



/* =========================================================
   LUCES
========================================================= */

.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(100px);

}


.ambient-one {

    width: 330px;

    height: 330px;

    top: 150px;

    right: 2%;

    background: rgba(91,145,99,.20);

}


.ambient-two {

    width: 300px;

    height: 300px;

    bottom: 0;

    left: 20%;

    background: rgba(49,94,67,.20);

}


.ambient-three {

    width: 180px;

    height: 180px;

    top: 650px;

    left: 3%;

    background: rgba(139,182,121,.08);

}



/* =========================================================
   ALERT
========================================================= */

.glass-alert {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 17px;

    padding: 12px 15px;

    border-radius: 15px;

    border: 1px solid rgba(144,205,151,.18);

    background: rgba(81,145,88,.10);

    color: #e0f3e3;

}


.glass-alert-icon {

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: rgba(154,207,158,.16);

    color: #a4d2a5;

}


.glass-alert strong {

    display: block;

    font-size: 9px;

}


.glass-alert span {

    color: rgba(219,239,223,.51);

    font-size: 8px;

}



/* =========================================================
   HERO
========================================================= */

.patient-hero-glass {

    position: relative;

    z-index: 2;

    overflow: hidden;

    min-height: 190px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 31px 38px;

    border-radius: 28px;

    border: 1px solid rgba(255,255,255,.13);

    background:

        linear-gradient(
            135deg,
            rgba(255,255,255,.10),
            rgba(255,255,255,.025)
        );

    backdrop-filter:
        blur(27px)
        saturate(140%);

    -webkit-backdrop-filter:
        blur(27px)
        saturate(140%);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.15),

        0 24px 55px rgba(0,0,0,.18);

}


.patient-hero-glass::before {

    content: "";

    position: absolute;

    width: 500px;

    height: 150px;

    top: -110px;

    left: 15%;

    border-radius: 50%;

    background: rgba(255,255,255,.06);

    filter: blur(18px);

}


.patient-hero-main {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    gap: 23px;

}


.hero-avatar {

    width: 92px;

    height: 92px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 28px;

    border: 1px solid rgba(255,255,255,.17);

    background:

        linear-gradient(
            145deg,
            rgba(177,211,165,.22),
            rgba(255,255,255,.045)
        );

    color: #b8d8ae;

    font-size: 26px;

    font-weight: 600;

    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.14);

}


.hero-eyebrow {

    color: #90b498;

    font-size: 8px;

    letter-spacing: 1.7px;

}


.hero-patient-info h2 {

    margin: 5px 0 6px;

    color: #f4faf5;

    font-size: 27px;

    font-weight: 500;

}


.hero-patient-info > p {

    margin: 0;

    color: rgba(214,231,217,.42);

    font-size: 9px;

}


.hero-patient-info > p i {

    margin-right: 5px;

    color: #89ad8b;

}


.hero-badges {

    display: flex;

    flex-wrap: wrap;

    gap: 7px;

    margin-top: 14px;

}


.status-badge,
.soft-badge {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 9px;

    border-radius: 20px;

    border: 1px solid rgba(255,255,255,.07);

    font-size: 7px;

}


.status-badge.active {

    color: #9ed2a5;

    background: rgba(81,161,95,.08);

}


.status-badge.inactive {

    color: #adb8af;

    background: rgba(255,255,255,.035);

}


.status-badge span {

    width: 5px;

    height: 5px;

    border-radius: 50%;

    background: currentColor;

    box-shadow: 0 0 7px currentColor;

}


.soft-badge {

    color: rgba(216,232,219,.43);

    background: rgba(255,255,255,.025);

}



/* =========================================================
   HERO SUMMARY
========================================================= */

.hero-summary {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    gap: 12px;

}


.summary-mini {

    min-width: 100px;

    padding: 12px 14px;

    border-radius: 16px;

    border: 1px solid rgba(255,255,255,.09);

    background: rgba(255,255,255,.035);

}


.summary-mini span {

    display: block;

    color: rgba(191,214,195,.30);

    font-size: 6px;

    letter-spacing: 1px;

}


.summary-mini strong {

    display: block;

    margin-top: 4px;

    color: #eaf5ec;

    font-size: 14px;

    font-weight: 500;

}


.hero-decoration {

    width: 82px;

    height: 82px;

    display: flex;

    align-items: center;

    justify-content: center;

    color: rgba(166,204,153,.28);

    font-size: 55px;

}



/* =========================================================
   GRID SUPERIOR
========================================================= */

.top-grid {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        minmax(280px,.55fr)
        minmax(0,1.45fr);

    gap: 17px;

    margin-top: 18px;

}


.left-column {

    display: flex;

    flex-direction: column;

    gap: 16px;

}


.right-column {

    min-width: 0;

}



/* =========================================================
   GLASS CARD
========================================================= */

.glass-card,
.goal-glass,
.privacy-glass,
.evaluation-glass,
.weight-chart-glass,
.history-glass,
.progress-section,
.chart-waiting-glass,
.empty-evaluation-glass {

    border-radius: 24px;

    border: 1px solid rgba(255,255,255,.10);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.072),
            rgba(255,255,255,.018)
        );

    backdrop-filter: blur(23px);

    -webkit-backdrop-filter: blur(23px);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.10),

        0 17px 38px rgba(0,0,0,.11);

}


.glass-card {

    padding: 22px;

}



/* =========================================================
   HEADINGS
========================================================= */

.card-heading,
.section-title-row,
.chart-header,
.history-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

}


.card-heading {

    margin-bottom: 18px;

}


.card-heading span,
.section-eyebrow {

    display: block;

    margin-bottom: 3px;

    color: rgba(182,210,187,.34);

    font-size: 7px;

    letter-spacing: 1.4px;

}


.card-heading h4,
.section-title-row h3,
.chart-header h3,
.history-header h3 {

    margin: 0;

    color: #edf7ef;

    font-size: 15px;

    font-weight: 500;

}


.heading-icon,
.section-small-icon,
.chart-icon {

    width: 40px;

    height: 40px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background: rgba(144,187,138,.08);

    color: #9bbf95;

}



/* =========================================================
   CONTACTO
========================================================= */

.contact-list {

    display: flex;

    flex-direction: column;

    gap: 10px;

}


.contact-item {

    display: flex;

    align-items: center;

    gap: 11px;

    padding: 11px;

    border-radius: 15px;

    border: 1px solid rgba(255,255,255,.055);

    background: rgba(255,255,255,.025);

}


.contact-icon {

    width: 35px;

    height: 35px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: rgba(142,185,136,.07);

    color: #91b38d;

    font-size: 9px;

}


.contact-item span {

    display: block;

    color: rgba(203,222,207,.28);

    font-size: 6px;

}


.contact-item strong {

    display: block;

    margin-top: 2px;

    color: rgba(235,245,237,.68);

    font-size: 8px;

    font-weight: 500;

    word-break: break-word;

}



/* =========================================================
   OBJETIVO
========================================================= */

.goal-glass {

    padding: 21px;

}


.goal-icon {

    width: 41px;

    height: 41px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 15px;

    border-radius: 13px;

    background: rgba(144,187,138,.09);

    color: #9fc299;

}


.goal-label {

    color: rgba(182,210,187,.31);

    font-size: 7px;

    letter-spacing: 1.4px;

}


.goal-glass h4 {

    margin: 4px 0 8px;

    color: #edf7ef;

    font-size: 14px;

}


.goal-glass p {

    margin: 0;

    color: rgba(210,229,214,.40);

    font-size: 8px;

    line-height: 1.7;

}



/* =========================================================
   PRIVACY
========================================================= */

.privacy-glass {

    display: flex;

    gap: 10px;

    padding: 15px;

}


.privacy-glass > div {

    width: 34px;

    height: 34px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: rgba(141,182,136,.07);

    color: #8fac8d;

    font-size: 9px;

}


.privacy-glass p {

    margin: 0;

    color: rgba(206,225,210,.28);

    font-size: 7px;

    line-height: 1.55;

}


.privacy-glass strong {

    display: block;

    margin-bottom: 2px;

    color: rgba(232,242,234,.57);

    font-size: 8px;

}



/* =========================================================
   GENERAL INFO
========================================================= */

.general-info-grid {

    display: grid;

    grid-template-columns:
        repeat(2,minmax(0,1fr));

    gap: 11px;

}


.general-info-item {

    display: flex;

    align-items: center;

    gap: 10px;

    min-height: 78px;

    padding: 13px;

    border-radius: 16px;

    border: 1px solid rgba(255,255,255,.055);

    background: rgba(255,255,255,.025);

}


.info-icon {

    width: 37px;

    height: 37px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    background: rgba(144,187,138,.07);

    color: #96b892;

    font-size: 9px;

}


.general-info-item span {

    display: block;

    color: rgba(201,221,205,.28);

    font-size: 6px;

}


.general-info-item strong {

    display: block;

    margin-top: 3px;

    color: rgba(238,247,240,.71);

    font-size: 9px;

    font-weight: 500;

}



/* =========================================================
   EVALUACIÓN
========================================================= */

.evaluation-glass {

    position: relative;

    z-index: 2;

    margin-top: 18px;

    padding: 24px;

}


.evaluation-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 20px;

}


.evaluation-header h3 {

    margin: 2px 0;

    color: #eff8f1;

    font-size: 18px;

    font-weight: 500;

}


.evaluation-header p {

    margin: 0;

    color: rgba(211,229,214,.34);

    font-size: 8px;

}


.evaluation-badge {

    padding: 8px 11px;

    border-radius: 12px;

    border: 1px solid rgba(255,255,255,.07);

    background: rgba(255,255,255,.03);

    color: rgba(205,225,209,.39);

    font-size: 7px;

}


.evaluation-metrics {

    display: grid;

    grid-template-columns:
        repeat(4,1fr);

    gap: 12px;

}


.metric-glass {

    padding: 17px;

    border-radius: 18px;

    border: 1px solid rgba(255,255,255,.07);

    background: rgba(255,255,255,.027);

}


.metric-icon {

    width: 37px;

    height: 37px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 13px;

    border-radius: 12px;

    background: rgba(141,183,136,.08);

    color: #9abe94;

    font-size: 10px;

}


.metric-glass > span {

    color: rgba(192,215,197,.30);

    font-size: 6px;

    letter-spacing: 1px;

}


.metric-glass h3 {

    margin: 5px 0 0;

    color: #eef7f0;

    font-size: 22px;

    font-weight: 500;

}


.metric-glass h3 small {

    color: rgba(206,226,210,.35);

    font-size: 8px;

    font-weight: 400;

}



/* =========================================================
   SIN EVALUACIONES
========================================================= */

.empty-evaluation-glass,
.chart-waiting-glass {

    position: relative;

    z-index: 2;

    margin-top: 18px;

    padding: 55px 25px;

    text-align: center;

}


.empty-evaluation-icon,
.chart-waiting-glass > div {

    width: 65px;

    height: 65px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: auto auto 15px;

    border-radius: 21px;

    background: rgba(144,187,138,.08);

    color: #9abc94;

    font-size: 23px;

}


.empty-evaluation-glass > span,
.chart-waiting-glass > span {

    color: rgba(181,209,186,.32);

    font-size: 7px;

    letter-spacing: 1.4px;

}


.empty-evaluation-glass h3,
.chart-waiting-glass h4 {

    margin: 5px 0 8px;

    color: #edf7ef;

    font-size: 17px;

}


.empty-evaluation-glass p,
.chart-waiting-glass p {

    max-width: 440px;

    margin: 0 auto 18px;

    color: rgba(210,228,213,.36);

    font-size: 8px;

    line-height: 1.65;

}



/* =========================================================
   PROGRESO
========================================================= */

.progress-section {

    position: relative;

    z-index: 2;

    margin-top: 18px;

    padding: 24px;

}


.progress-grid {

    display: grid;

    grid-template-columns:
        repeat(4,1fr);

    gap: 12px;

    margin-top: 18px;

}


.progress-glass-card {

    padding: 17px;

    border-radius: 18px;

    border: 1px solid rgba(255,255,255,.065);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.04),
            rgba(255,255,255,.015)
        );

}


.progress-glass-card > span {

    color: rgba(190,214,194,.28);

    font-size: 6px;

    letter-spacing: 1px;

}


.progress-glass-card h3 {

    margin: 7px 0 4px;

    color: #eef7f0;

    font-size: 21px;

    font-weight: 500;

}


.progress-glass-card h3 small {

    font-size: 8px;

    color: rgba(210,229,214,.34);

    font-weight: 400;

}


.progress-glass-card p {

    margin: 0;

    color: rgba(208,226,211,.29);

    font-size: 7px;

}


.progress-positive {

    color: #91c99a !important;

}


.progress-warning {

    color: #d5ba74 !important;

}



/* =========================================================
   CHART
========================================================= */

.weight-chart-glass {

    position: relative;

    z-index: 2;

    margin-top: 18px;

    padding: 24px;

}


.chart-header p,
.history-header p {

    margin: 5px 0 0;

    color: rgba(208,228,212,.32);

    font-size: 8px;

}


.chart-wrapper {

    position: relative;

    height: 315px;

    margin-top: 18px;

}



/* =========================================================
   HISTORIAL
========================================================= */

.history-glass {

    position: relative;

    z-index: 2;

    margin-top: 18px;

    padding: 24px;

}


.history-header {

    margin-bottom: 18px;

}


.empty-history {

    padding: 35px;

    text-align: center;

    color: rgba(210,228,214,.33);

    font-size: 8px;

}


.empty-history i {

    display: block;

    margin-bottom: 8px;

    color: #8fad8b;

    font-size: 22px;

}



/* =========================================================
   TABLA
========================================================= */

.liquid-table {

    width: 100%;

    border-collapse: separate;

    border-spacing: 0 5px;

}


.liquid-table thead th {

    padding: 10px 13px;

    border: none;

    color: rgba(190,214,194,.29);

    font-size: 7px;

    font-weight: 500;

    letter-spacing: .8px;

    text-transform: uppercase;

}


.liquid-table tbody tr {

    background: rgba(255,255,255,.025);

    transition: .2s;

}


.liquid-table tbody tr:hover {

    background: rgba(143,187,137,.065);

}


.liquid-table td {

    padding: 12px 13px;

    border-top: 1px solid rgba(255,255,255,.04);

    border-bottom: 1px solid rgba(255,255,255,.04);

    color: rgba(222,236,225,.55);

    font-size: 8px;

    vertical-align: middle;

}


.liquid-table td:first-child {

    border-left: 1px solid rgba(255,255,255,.04);

    border-radius: 13px 0 0 13px;

}


.liquid-table td:last-child {

    border-right: 1px solid rgba(255,255,255,.04);

    border-radius: 0 13px 13px 0;

}


.liquid-table td strong {

    color: #eaf5ec;

    font-weight: 500;

}


.liquid-table td small {

    color: rgba(206,225,210,.30);

    font-size: 7px;

}


.table-date {

    width: 42px;

    height: 44px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    background: rgba(142,184,136,.08);

}


.table-date div {

    color: #aaca9f;

    font-size: 13px;

    font-weight: 600;

    line-height: 14px;

}


.table-date span {

    color: rgba(207,226,211,.31);

    font-size: 6px;

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 1100px) {

    .patient-hero-glass {

        align-items: flex-start;

    }

    .hero-summary {

        display: none;

    }


    .top-grid {

        grid-template-columns: 1fr;

    }


    .left-column {

        display: grid;

        grid-template-columns:
            1fr
            1fr;

    }


    .privacy-glass {

        grid-column: 1 / -1;

    }


    .evaluation-metrics,
    .progress-grid {

        grid-template-columns:
            repeat(2,1fr);

    }

}


@media(max-width: 767px) {

    .patient-show-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .header-actions {

        width: 100%;

    }


    .header-actions a {

        flex: 1;

    }


    .patient-hero-glass {

        padding: 25px 20px;

    }


    .patient-hero-main {

        align-items: flex-start;

    }


    .hero-avatar {

        width: 65px;

        height: 65px;

        border-radius: 20px;

        font-size: 18px;

    }


    .hero-patient-info h2 {

        font-size: 21px;

    }


    .left-column {

        display: flex;

    }


    .general-info-grid {

        grid-template-columns: 1fr;

    }


    .evaluation-header,
    .history-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .evaluation-metrics,
    .progress-grid {

        grid-template-columns:
            1fr
            1fr;

    }


    .history-header .btn-liquid-primary {

        width: 100%;

    }


    .liquid-table {

        min-width: 720px;

    }

}


@media(max-width: 480px) {

    .patient-hero-main {

        flex-direction: column;

    }


    .evaluation-metrics,
    .progress-grid {

        grid-template-columns: 1fr;

    }

}

</style>

@stop



@section('js')

@if($showWeightChart)

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas =
        document.getElementById('weightChart');


    if (!canvas) {
        return;
    }


    const labels =
        @json($weightLabels);

    const weights =
        @json($weightData);


    const ctx =
        canvas.getContext('2d');


    const gradient =
        ctx.createLinearGradient(
            0,
            0,
            0,
            310
        );


    gradient.addColorStop(
        0,
        'rgba(159, 199, 153, .25)'
    );


    gradient.addColorStop(
        1,
        'rgba(159, 199, 153, 0)'
    );


    new Chart(canvas, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [

                {

                    label: 'Peso',

                    data: weights,

                    borderColor: '#9fc799',

                    backgroundColor: gradient,

                    borderWidth: 2,

                    fill: true,

                    tension: .42,

                    pointRadius: 4,

                    pointHoverRadius: 6,

                    pointBackgroundColor: '#afd3a5',

                    pointBorderColor: '#17301f',

                    pointBorderWidth: 2

                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,


            interaction: {

                intersect: false,

                mode: 'index'

            },


            plugins: {

                legend: {

                    display: false

                },


                tooltip: {

                    backgroundColor:
                        'rgba(12, 31, 20, .96)',

                    borderColor:
                        'rgba(255,255,255,.10)',

                    borderWidth: 1,

                    padding: 10,

                    displayColors: false,


                    callbacks: {

                        label: function(context) {

                            return 'Peso: '
                                + context.parsed.y
                                + ' kg';

                        }

                    }

                }

            },


            scales: {

                y: {

                    beginAtZero: false,

                    border: {

                        display: false

                    },

                    grid: {

                        color:
                            'rgba(255,255,255,.045)'

                    },

                    ticks: {

                        color:
                            'rgba(211,229,215,.36)',

                        font: {

                            size: 8

                        },

                        callback: function(value) {

                            return value + ' kg';

                        }

                    }

                },


                x: {

                    border: {

                        display: false

                    },

                    grid: {

                        display: false

                    },

                    ticks: {

                        color:
                            'rgba(211,229,215,.36)',

                        font: {

                            size: 8

                        }

                    }

                }

            }

        }

    });

});

</script>

@endif

@stop