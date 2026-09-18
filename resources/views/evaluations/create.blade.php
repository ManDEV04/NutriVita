@extends('adminlte::page')

@section('title', 'Nueva evaluación | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
@section('content_header')

    <div class="evaluation-page-header">

        <div>
            <span class="header-eyebrow">
                <i class="fas fa-leaf mr-1"></i>
                NUTRIADMIN · SEGUIMIENTO
            </span>

            <h1>Nueva evaluación</h1>

            <p>
                {{ $paciente->first_name }}
                {{ $paciente->last_name }}
            </p>
        </div>

        <a href="{{ route('pacientes.show', $paciente) }}" class="btn-liquid-secondary">
            <i class="fas fa-arrow-left"></i>
            Regresar
        </a>

    </div>

@stop


{{-- =========================================================
     CONTENT
     ========================================================= --}}
@section('content')

    @php
        $measurements = [
            'waist' => ['label' => 'Cintura', 'icon' => 'fa-ruler-horizontal'],
            'hip' => ['label' => 'Cadera', 'icon' => 'fa-ruler'],
            'chest' => ['label' => 'Pecho', 'icon' => 'fa-expand'],
            'arm' => ['label' => 'Brazo', 'icon' => 'fa-dumbbell'],
            'thigh' => ['label' => 'Muslo', 'icon' => 'fa-ruler-combined'],
        ];
    @endphp

    <div class="evaluation-page">

        {{-- Luces ambientales --}}
        <div class="ambient ambient-one"></div>
        <div class="ambient ambient-two"></div>
        <div class="ambient ambient-three"></div>

        <form method="POST" action="{{ route('evaluaciones.store', $paciente) }}" id="evaluationForm">
            @csrf

            <div class="evaluation-layout">

                {{-- =========================================
                     FORMULARIO
                     ========================================= --}}
                @include('evaluations.partials.create-form')

                {{-- =========================================
                     PANEL DERECHO
                     ========================================= --}}
                @include('evaluations.partials.create-sidebar')

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


    @vite(['resources/js/pages/evaluations-create.js'])

@stop
