@extends('adminlte::page')

@section('title', 'Progreso | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
@section('content_header')

    <div class="progress-header">

        <div>
            <span class="progress-eyebrow">
                <i class="fas fa-leaf mr-1"></i>
                NUTRIADMIN
            </span>

            <h1>Progreso</h1>

            <p>Consulta la evolución de tus pacientes.</p>
        </div>

    </div>

@stop


{{-- =========================================================
     CONTENT
     ========================================================= --}}
@section('content')

    <div class="progress-page">

        {{-- =================================================
             MÉTRICAS
             ================================================= --}}
        @include('progress.partials.index-stats')


        {{-- =================================================
             PACIENTES
             ================================================= --}}
        @include('progress.partials.index-patients')

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
