@extends('adminlte::page')

@section('title', 'Pacientes | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
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


{{-- =========================================================
     CONTENT
     ========================================================= --}}
@section('content')

    <div class="nutri-patients-page">

        {{-- Decoración de fondo --}}
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
        @include('patients.partials.hero')


        {{-- =================================================
             MÉTRICAS
             ================================================= --}}
        @include('patients.partials.stats')


        {{-- =================================================
             BUSCADOR
             ================================================= --}}
        @include('patients.partials.toolbar')


        {{-- =================================================
             LISTADO
             ================================================= --}}
        @include('patients.partials.list')

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

//Prueba 
{{-- =========================================================
     SCRIPTS
     ========================================================= --}}
@section('js')

    @vite(['resources/js/theme.js'])


    @vite(['resources/js/pages/patients-index.js'])

@stop
