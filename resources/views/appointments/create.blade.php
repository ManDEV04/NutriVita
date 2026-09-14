@extends('adminlte::page')

@section('title', 'Nueva cita | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
@section('content_header')

    <div class="appointment-page-header">

        <div>
            <span class="header-eyebrow">
                <i class="fas fa-leaf mr-1"></i>
                NUTRIADMIN · AGENDA
            </span>

            <h1>Nueva cita</h1>

            <p>Programa una consulta con uno de tus pacientes.</p>
        </div>

        <a href="{{ route('citas.index') }}" class="btn-liquid-secondary">
            <i class="fas fa-arrow-left"></i>
            Regresar
        </a>

    </div>

@stop


{{-- =========================================================
     CONTENT
     ========================================================= --}}
@section('content')

    <div class="appointment-create-page">

        {{-- Luces ambientales --}}
        <div class="ambient ambient-one"></div>
        <div class="ambient ambient-two"></div>
        <div class="ambient ambient-three"></div>

        <form method="POST" action="{{ route('citas.store') }}" id="appointmentForm">
            @csrf

            <div class="appointment-layout">

                {{-- =========================================
                     FORMULARIO PRINCIPAL
                     ========================================= --}}
                @include('appointments.partials.create-form')

                {{-- =========================================
                     PANEL DERECHO
                     ========================================= --}}
                @include('appointments.partials.create-sidebar')

            </div>

        </form>

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

    @vite(['resources/js/theme.js'])


    @vite(['resources/js/pages/appointments-create.js'])

@stop
