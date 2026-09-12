@extends('adminlte::page')

@section('title', 'Pacientes | NutriAdmin')


@section('content_header')

<div class="patients-header">

    <div>
        <span class="header-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN
        </span>

        <h1>Pacientes</h1>

        <p>
            Administra y consulta la información de tus pacientes.
        </p>
    </div>

    <a href="{{ route('pacientes.create') }}"
       class="btn-liquid-primary">

        <i class="fas fa-plus"></i>

        <span>Nuevo paciente</span>

    </a>

</div>

@stop



@section('content')


<div class="nutri-patients-page">


    {{-- DECORACIÓN DE FONDO --}}
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



    {{-- PANEL SUPERIOR --}}
    <div class="hero-glass">

        <div class="hero-content">

            <div class="hero-icon">
                <i class="fas fa-user-friends"></i>
            </div>

            <div>

                <span class="hero-small">
                    Gestión de pacientes
                </span>

                <h2>
                    Tu comunidad
                    <span>saludable.</span>
                </h2>

                <p>
                    Consulta, organiza y da seguimiento a cada paciente
                    desde un mismo lugar.
                </p>

            </div>

        </div>


        <div class="hero-decoration">

            <div class="leaf-orbit orbit-one">
                <i class="fas fa-leaf"></i>
            </div>

            <div class="leaf-orbit orbit-two">
                <i class="fas fa-seedling"></i>
            </div>

            <div class="hero-plant">
                <i class="fas fa-spa"></i>
            </div>

        </div>

    </div>



    {{-- MÉTRICAS --}}
    <div class="stats-grid">

        <div class="liquid-stat">

            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>

            <div>
                <span>Total pacientes</span>

                <h3>
                    {{ $patients->count() }}
                </h3>
            </div>

        </div>


        <div class="liquid-stat">

            <div class="stat-icon active-icon">
                <i class="fas fa-user-check"></i>
            </div>

            <div>
                <span>Pacientes activos</span>

                <h3>
                    {{ $patients->where('active', true)->count() }}
                </h3>
            </div>

        </div>


        <div class="liquid-stat">

            <div class="stat-icon inactive-icon">
                <i class="fas fa-user-clock"></i>
            </div>

            <div>
                <span>Inactivos</span>

                <h3>
                    {{ $patients->where('active', false)->count() }}
                </h3>
            </div>

        </div>

    </div>



    {{-- BUSCADOR --}}
    <div class="glass-toolbar">

        <div class="search-glass">

            <i class="fas fa-search"></i>

            <input
                type="text"
                id="patientSearch"
                placeholder="Buscar paciente..."
                autocomplete="off"
            >

        </div>


        <div class="toolbar-right">

            <span class="patient-count">

                <i class="fas fa-user-friends mr-1"></i>

                {{ $patients->count() }}

                {{ $patients->count() === 1 ? 'paciente' : 'pacientes' }}

            </span>

        </div>

    </div>



    @if($patients->isEmpty())


        {{-- ESTADO VACÍO --}}
        <div class="empty-liquid">

            <div class="empty-visual">

                <div class="empty-glass-circle">

                    <i class="fas fa-users"></i>

                </div>

                <span class="floating-leaf leaf-a">
                    <i class="fas fa-leaf"></i>
                </span>

                <span class="floating-leaf leaf-b">
                    <i class="fas fa-seedling"></i>
                </span>

            </div>


            <h3>
                Aún no tienes pacientes
            </h3>

            <p>
                Registra tu primer paciente para comenzar
                a llevar su seguimiento nutricional.
            </p>


            <a href="{{ route('pacientes.create') }}"
               class="btn-liquid-primary">

                <i class="fas fa-plus"></i>
                Agregar paciente

            </a>

        </div>


    @else


        {{-- GRID DE PACIENTES --}}
        <div class="patients-grid" id="patientsGrid">


            @foreach($patients as $patient)

                <div class="patient-glass-card"
                     data-patient="
                        {{ strtolower(
                            $patient->first_name . ' ' .
                            $patient->last_name . ' ' .
                            ($patient->email ?? '') . ' ' .
                            ($patient->phone ?? '')
                        ) }}
                     ">


                    {{-- BRILLO SUPERIOR --}}
                    <div class="glass-shine"></div>


                    {{-- ENCABEZADO TARJETA --}}
                    <div class="patient-card-top">

                        <div class="patient-avatar">

                            {{ strtoupper(substr($patient->first_name, 0, 1)) }}

                        </div>


                        <div class="patient-status">

                            @if($patient->active)

                                <span class="status-active">

                                    <span class="status-dot"></span>

                                    Activo

                                </span>

                            @else

                                <span class="status-inactive">

                                    <span class="status-dot"></span>

                                    Inactivo

                                </span>

                            @endif

                        </div>

                    </div>



                    {{-- DATOS PRINCIPALES --}}
                    <div class="patient-main-info">

                        <span class="patient-label">
                            Paciente
                        </span>

                        <h3>

                            {{ $patient->first_name }}
                            {{ $patient->last_name }}

                        </h3>


                        <div class="patient-contact">

                            @if($patient->email)

                                <div>

                                    <i class="far fa-envelope"></i>

                                    <span>
                                        {{ $patient->email }}
                                    </span>

                                </div>

                            @endif


                            @if($patient->phone)

                                <div>

                                    <i class="fas fa-phone-alt"></i>

                                    <span>
                                        {{ $patient->phone }}
                                    </span>

                                </div>

                            @endif

                        </div>

                    </div>



                    {{-- OBJETIVO --}}
                    <div class="patient-goal">

                        <div class="goal-icon">

                            <i class="fas fa-bullseye"></i>

                        </div>

                        <div>

                            <span>
                                Objetivo
                            </span>

                            <p>
                                {{ $patient->goal ?? 'Sin objetivo registrado' }}
                            </p>

                        </div>

                    </div>



                    {{-- ACCIONES --}}
                    <div class="patient-actions">

                        <a href="{{ route('pacientes.show', $patient) }}"
                           class="glass-action primary-action">

                            <i class="far fa-eye"></i>

                            <span>
                                Ver paciente
                            </span>

                        </a>


                        <a href="{{ route('pacientes.edit', $patient) }}"
                           class="glass-action edit-action"
                           title="Editar paciente">

                            <i class="far fa-edit"></i>

                        </a>

                    </div>


                </div>

            @endforeach


        </div>



        {{-- MENSAJE DE BÚSQUEDA --}}
        <div class="no-results" id="noResults">

            <div>
                <i class="fas fa-search"></i>
            </div>

            <h4>
                No encontramos pacientes
            </h4>

            <p>
                Prueba con otro nombre, correo o teléfono.
            </p>

        </div>


    @endif


</div>

@stop





@section('css')

<link rel="stylesheet"
      href="{{ asset('css/nutriadmin.css') }}">

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>


<style>


/* =========================================================
   FONDO GENERAL
========================================================= */

body {
    background:
        radial-gradient(
            circle at 15% 10%,
            rgba(54, 104, 75, .20),
            transparent 28%
        ),
        radial-gradient(
            circle at 90% 35%,
            rgba(99, 152, 105, .12),
            transparent 28%
        ),
        linear-gradient(
            135deg,
            #091710 0%,
            #10241a 45%,
            #0a1912 100%
        ) !important;

    background-attachment: fixed !important;
}


.content-wrapper {
    background: transparent !important;
}


.content-header {
    background: transparent !important;
}



/* =========================================================
   HEADER
========================================================= */

.patients-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

    padding-top: 7px;

}


.header-eyebrow {

    display: block;

    margin-bottom: 6px;

    color: #8fb99b;

    font-size: 10px;

    letter-spacing: 2.2px;

    font-weight: 700;

}


.patients-header h1 {

    margin: 0;

    color: #f5fbf6;

    font-size: 32px;

    font-weight: 600;

    letter-spacing: -.6px;

}


.patients-header p {

    margin-top: 6px;

    margin-bottom: 0;

    color: rgba(218, 235, 222, .55);

    font-size: 13px;

}



/* =========================================================
   BOTÓN PRINCIPAL
========================================================= */

.btn-liquid-primary {

    position: relative;

    overflow: hidden;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    padding: 11px 18px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.22);

    background:
        linear-gradient(
            135deg,
            rgba(177, 219, 164, .95),
            rgba(114, 168, 114, .82)
        );

    color: #102417 !important;

    font-weight: 700;

    font-size: 13px;

    text-decoration: none !important;

    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.65),
        0 10px 30px rgba(79, 145, 94, .23);

    transition:
        transform .25s ease,
        box-shadow .25s ease;

}


.btn-liquid-primary::before {

    content: "";

    position: absolute;

    top: -80%;

    left: -30%;

    width: 75%;

    height: 230%;

    transform: rotate(25deg);

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.40),
            transparent
        );

    transition: .45s;

}


.btn-liquid-primary:hover {

    transform: translateY(-2px);

    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.70),
        0 15px 35px rgba(79,145,94,.30);

}


.btn-liquid-primary:hover::before {

    left: 110%;

}



/* =========================================================
   PÁGINA
========================================================= */

.nutri-patients-page {

    position: relative;

    min-height: 700px;

    padding-bottom: 40px;

}


.ambient {

    pointer-events: none;

    position: fixed;

    border-radius: 50%;

    filter: blur(90px);

    opacity: .24;

    z-index: 0;

}


.ambient-one {

    width: 320px;

    height: 320px;

    background: #527f5a;

    top: 120px;

    right: 4%;

}


.ambient-two {

    width: 260px;

    height: 260px;

    background: #315d43;

    bottom: 0;

    left: 20%;

}


.ambient-three {

    width: 170px;

    height: 170px;

    background: #8daf78;

    top: 450px;

    left: 3%;

    opacity: .10;

}



/* =========================================================
   ALERT
========================================================= */

.glass-alert {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 13px 17px;

    margin-bottom: 20px;

    border-radius: 14px;

    border: 1px solid rgba(160, 215, 165, .25);

    background: rgba(86, 147, 93, .14);

    backdrop-filter: blur(20px);

    -webkit-backdrop-filter: blur(20px);

    color: #dff5e2;

}


.glass-alert-icon {

    width: 34px;

    height: 34px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: #16331f;

    background: #9cd59f;

}


.glass-alert strong {

    display: block;

    font-size: 13px;

}


.glass-alert span {

    display: block;

    color: rgba(226,246,229,.70);

    font-size: 12px;

}



/* =========================================================
   HERO LIQUID GLASS
========================================================= */

.hero-glass {

    position: relative;

    z-index: 2;

    overflow: hidden;

    min-height: 210px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 35px 42px;

    border-radius: 26px;

    border: 1px solid rgba(255,255,255,.15);

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.115),
            rgba(255,255,255,.035)
        );

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.18),
        inset 0 -1px 0 rgba(255,255,255,.04),
        0 25px 60px rgba(0,0,0,.22);

    backdrop-filter: blur(28px) saturate(145%);

    -webkit-backdrop-filter:
        blur(28px) saturate(145%);

}


.hero-glass::before {

    content: "";

    position: absolute;

    width: 520px;

    height: 180px;

    top: -100px;

    left: 10%;

    border-radius: 50%;

    background:
        rgba(255,255,255,.08);

    filter: blur(20px);

    transform: rotate(-8deg);

}


.hero-content {

    position: relative;

    z-index: 4;

    display: flex;

    align-items: center;

    gap: 25px;

    max-width: 650px;

}


.hero-icon {

    min-width: 78px;

    width: 78px;

    height: 78px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 23px;

    border: 1px solid rgba(255,255,255,.22);

    background:
        linear-gradient(
            145deg,
            rgba(168, 205, 154, .24),
            rgba(255,255,255,.06)
        );

    color: #afd39f;

    font-size: 29px;

    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.18),
        0 15px 35px rgba(0,0,0,.15);

}


.hero-small {

    color: #9ac0a1;

    font-size: 11px;

    letter-spacing: 1.8px;

    text-transform: uppercase;

}


.hero-content h2 {

    margin:

        7px 0 10px;

    color: #f3faf5;

    font-size: 34px;

    font-weight: 400;

    letter-spacing: -.8px;

}


.hero-content h2 span {

    color: #a8cc99;

    font-weight: 600;

}


.hero-content p {

    max-width: 520px;

    margin: 0;

    color: rgba(225, 238, 227, .57);

    font-size: 13px;

    line-height: 1.7;

}



/* =========================================================
   DECORACIÓN HERO
========================================================= */

.hero-decoration {

    position: relative;

    width: 240px;

    height: 160px;

}


.hero-plant {

    position: absolute;

    right: 40px;

    bottom: -5px;

    width: 125px;

    height: 125px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: rgba(166, 204, 150, .55);

    font-size: 88px;

    filter:
        drop-shadow(
            0 12px 18px
            rgba(0,0,0,.20)
        );

}


.leaf-orbit {

    position: absolute;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 1px solid rgba(255,255,255,.18);

    background: rgba(255,255,255,.06);

    backdrop-filter: blur(12px);

    color: #9bc590;

    border-radius: 50%;

}


.orbit-one {

    width: 48px;

    height: 48px;

    top: 15px;

    left: 35px;

}


.orbit-two {

    width: 36px;

    height: 36px;

    right: 0;

    top: 10px;

}



/* =========================================================
   ESTADÍSTICAS
========================================================= */

.stats-grid {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 16px;

    margin-top: 18px;

}


.liquid-stat {

    min-height: 100px;

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 18px;

    border: 1px solid rgba(255,255,255,.11);

    border-radius: 20px;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.085),
            rgba(255,255,255,.025)
        );

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.12),
        0 12px 28px rgba(0,0,0,.12);

    backdrop-filter: blur(22px);

    -webkit-backdrop-filter: blur(22px);

}


.stat-icon {

    width: 50px;

    height: 50px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    align-items: center;

    border-radius: 16px;

    color: #abd09f;

    background:
        rgba(154, 198, 146, .12);

    border: 1px solid rgba(176,215,167,.13);

}


.active-icon {

    color: #98d6a4;

}


.inactive-icon {

    color: #b4c6b5;

}


.liquid-stat span {

    display: block;

    margin-bottom: 3px;

    color: rgba(224,238,226,.46);

    font-size: 11px;

}


.liquid-stat h3 {

    margin: 0;

    color: #f3faf4;

    font-size: 25px;

    font-weight: 600;

}



/* =========================================================
   TOOLBAR
========================================================= */

.glass-toolbar {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-top: 24px;

    margin-bottom: 18px;

}


.search-glass {

    width: min(430px, 100%);

    height: 48px;

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 0 17px;

    border-radius: 16px;

    border: 1px solid rgba(255,255,255,.12);

    background:
        rgba(255,255,255,.055);

    backdrop-filter: blur(18px);

    -webkit-backdrop-filter: blur(18px);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.10);

}


.search-glass i {

    color: rgba(198,221,202,.47);

}


.search-glass input {

    width: 100%;

    border: none;

    outline: none;

    background: transparent;

    color: #edf8ef;

    font-size: 13px;

}


.search-glass input::placeholder {

    color:
        rgba(211,229,214,.35);

}


.patient-count {

    display: inline-flex;

    align-items: center;

    padding: 9px 13px;

    border: 1px solid rgba(255,255,255,.10);

    border-radius: 13px;

    background: rgba(255,255,255,.04);

    color: rgba(222,237,225,.52);

    font-size: 11px;

}



/* =========================================================
   GRID
========================================================= */

.patients-grid {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0,1fr));

    gap: 18px;

}



/* =========================================================
   TARJETA PACIENTE
========================================================= */

.patient-glass-card {

    position: relative;

    overflow: hidden;

    min-height: 310px;

    padding: 22px;

    border-radius: 24px;

    border: 1px solid rgba(255,255,255,.12);

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.095),
            rgba(255,255,255,.025)
        );

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.14),
        inset 0 -1px 0 rgba(255,255,255,.025),
        0 20px 45px rgba(0,0,0,.16);

    backdrop-filter:
        blur(24px)
        saturate(135%);

    -webkit-backdrop-filter:
        blur(24px)
        saturate(135%);

    transition:
        transform .3s ease,
        border-color .3s ease,
        box-shadow .3s ease;

}


.patient-glass-card:hover {

    transform: translateY(-6px);

    border-color:
        rgba(170, 210, 162, .25);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.18),
        0 28px 55px rgba(0,0,0,.24);

}


.patient-glass-card::after {

    content: "";

    position: absolute;

    right: -70px;

    bottom: -85px;

    width: 180px;

    height: 180px;

    border-radius: 50%;

    background:
        radial-gradient(
            circle,
            rgba(119, 167, 112, .20),
            transparent 68%
        );

}


.glass-shine {

    position: absolute;

    width: 180px;

    height: 90px;

    top: -50px;

    left: 25%;

    background:
        rgba(255,255,255,.07);

    filter: blur(22px);

    border-radius: 50%;

}



/* =========================================================
   AVATAR
========================================================= */

.patient-card-top {

    position: relative;

    z-index: 3;

    display: flex;

    justify-content: space-between;

    align-items: center;

}


.patient-avatar {

    width: 55px;

    height: 55px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 18px;

    border: 1px solid rgba(255,255,255,.18);

    background:
        linear-gradient(
            145deg,
            rgba(183, 215, 170, .26),
            rgba(255,255,255,.07)
        );

    color: #c2e0b7;

    font-size: 20px;

    font-weight: 700;

    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.17);

}



/* =========================================================
   ESTADO
========================================================= */

.patient-status span {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 7px 10px;

    border-radius: 30px;

    font-size: 10px;

}


.status-active {

    color: #a9ddb0;

    background: rgba(94, 170, 106, .10);

    border: 1px solid rgba(127,195,137,.13);

}


.status-inactive {

    color: #abb7ad;

    background: rgba(190,190,190,.06);

    border: 1px solid rgba(255,255,255,.07);

}


.status-dot {

    width: 6px;

    height: 6px;

    border-radius: 50%;

    background: currentColor;

    box-shadow:
        0 0 8px currentColor;

}



/* =========================================================
   INFORMACIÓN
========================================================= */

.patient-main-info {

    position: relative;

    z-index: 3;

    margin-top: 20px;

}


.patient-label {

    display: block;

    margin-bottom: 5px;

    color: rgba(208,226,211,.35);

    font-size: 9px;

    letter-spacing: 1.3px;

    text-transform: uppercase;

}


.patient-main-info h3 {

    margin: 0 0 11px;

    color: #f3faf5;

    font-size: 19px;

    font-weight: 600;

}


.patient-contact {

    min-height: 44px;

}


.patient-contact div {

    display: flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 5px;

    color: rgba(214,230,217,.47);

    font-size: 11px;

    overflow: hidden;

}


.patient-contact i {

    width: 13px;

    color: #7fa488;

    font-size: 10px;

}


.patient-contact span {

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

}



/* =========================================================
   OBJETIVO
========================================================= */

.patient-goal {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: flex-start;

    gap: 10px;

    margin-top: 13px;

    padding: 11px;

    min-height: 65px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.07);

    background: rgba(255,255,255,.035);

}


.goal-icon {

    min-width: 31px;

    width: 31px;

    height: 31px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    color: #96bd91;

    background: rgba(130, 181, 124, .09);

}


.patient-goal span {

    display: block;

    margin-bottom: 2px;

    color: rgba(202,221,205,.35);

    font-size: 9px;

    text-transform: uppercase;

    letter-spacing: .7px;

}


.patient-goal p {

    display: -webkit-box;

    overflow: hidden;

    margin: 0;

    color: rgba(231,241,233,.68);

    font-size: 11px;

    line-height: 1.45;

    -webkit-box-orient: vertical;

    -webkit-line-clamp: 2;

}



/* =========================================================
   ACCIONES
========================================================= */

.patient-actions {

    position: relative;

    z-index: 4;

    display: flex;

    gap: 8px;

    margin-top: 17px;

}


.glass-action {

    height: 40px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border-radius: 13px;

    border: 1px solid rgba(255,255,255,.12);

    text-decoration: none !important;

    transition: .22s ease;

}


.primary-action {

    flex: 1;

    color: #d7ecd5 !important;

    background:
        linear-gradient(
            135deg,
            rgba(129,175,120,.19),
            rgba(255,255,255,.045)
        );

    font-size: 11px;

    font-weight: 600;

}


.edit-action {

    width: 42px;

    color: #a7bdab !important;

    background:
        rgba(255,255,255,.04);

}


.glass-action:hover {

    color: #132418 !important;

    border-color:
        rgba(192, 222, 181, .40);

    background: #a8ca9b;

    transform: translateY(-2px);

}



/* =========================================================
   ESTADO VACÍO
========================================================= */

.empty-liquid {

    position: relative;

    z-index: 2;

    padding: 75px 20px;

    text-align: center;

    border: 1px solid rgba(255,255,255,.10);

    border-radius: 26px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.07),
            rgba(255,255,255,.02)
        );

    backdrop-filter: blur(24px);

}


.empty-visual {

    position: relative;

    width: 110px;

    height: 110px;

    margin: auto;

}


.empty-glass-circle {

    width: 95px;

    height: 95px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 30px;

    border: 1px solid rgba(255,255,255,.16);

    background: rgba(255,255,255,.07);

    color: #a7cb9d;

    font-size: 34px;

}


.floating-leaf {

    position: absolute;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #9cc492;

    color: #17301d;

}


.leaf-a {

    width: 33px;

    height: 33px;

    right: 0;

    top: -5px;

}


.leaf-b {

    width: 24px;

    height: 24px;

    left: -8px;

    bottom: 5px;

}


.empty-liquid h3 {

    margin-top: 22px;

    color: #eff8f1;

    font-size: 20px;

}


.empty-liquid p {

    max-width: 390px;

    margin: 8px auto 22px;

    color: rgba(218,234,221,.45);

    font-size: 12px;

}



/* =========================================================
   SIN RESULTADOS
========================================================= */

.no-results {

    display: none;

    position: relative;

    z-index: 2;

    padding: 60px;

    text-align: center;

    color: #fff;

}


.no-results > div {

    width: 60px;

    height: 60px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: auto auto 15px;

    border-radius: 20px;

    background: rgba(255,255,255,.07);

    color: #9fc596;

}


.no-results h4 {

    font-size: 18px;

}


.no-results p {

    color:
        rgba(221,234,223,.42);

    font-size: 12px;

}



/* =========================================================
   ADMIN LTE
========================================================= */

.main-header.navbar {

    border-bottom:
        1px solid rgba(255,255,255,.06) !important;

}


.card {

    background: transparent;

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 1100px) {

    .patients-grid {

        grid-template-columns:
            repeat(2, minmax(0,1fr));

    }

}


@media(max-width: 767px) {

    .patients-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .hero-glass {

        padding: 27px 22px;

    }


    .hero-decoration {

        display: none;

    }


    .hero-content {

        align-items: flex-start;

    }


    .hero-icon {

        width: 58px;

        min-width: 58px;

        height: 58px;

        border-radius: 18px;

        font-size: 22px;

    }


    .hero-content h2 {

        font-size: 25px;

    }


    .stats-grid {

        grid-template-columns: 1fr;

    }


    .patients-grid {

        grid-template-columns: 1fr;

    }


    .glass-toolbar {

        align-items: stretch;

        flex-direction: column;

    }


    .search-glass {

        width: 100%;

    }


    .toolbar-right {

        display: none;

    }

}

</style>

@stop





@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('patientSearch');

    const cards =
        document.querySelectorAll('.patient-glass-card');

    const noResults =
        document.getElementById('noResults');


    if (!searchInput) {
        return;
    }


    searchInput.addEventListener('input', function () {

        const search =
            this.value
                .toLowerCase()
                .trim();

        let visible = 0;


        cards.forEach(function (card) {

            const patient =
                card.dataset.patient
                    .toLowerCase();

            if (patient.includes(search)) {

                card.style.display = '';

                visible++;

            } else {

                card.style.display = 'none';

            }

        });


        if (noResults) {

            noResults.style.display =
                visible === 0
                    ? 'block'
                    : 'none';

        }

    });

});

</script>

@stop