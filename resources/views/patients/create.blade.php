@extends('adminlte::page')

@section('title', 'Nuevo paciente | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
@section('content_header')

    <div class="patient-form-header">

        <div>
            <span class="header-eyebrow">
                <i class="fas fa-leaf mr-1"></i>
                NUTRIADMIN
            </span>

            <h1>Nuevo paciente</h1>

            <p>Registra la información general del paciente.</p>
        </div>

        <a href="{{ route('pacientes.index') }}" class="btn-liquid-secondary">
            <i class="fas fa-arrow-left"></i>
            <span>Regresar</span>
        </a>

    </div>

@stop


{{-- =========================================================
     CONTENT
     ========================================================= --}}
@section('content')

    <div class="nutri-patient-form-page">

        {{-- Luces ambientales --}}
        <div class="ambient ambient-one"></div>
        <div class="ambient ambient-two"></div>
        <div class="ambient ambient-three"></div>

        <form method="POST" action="{{ route('pacientes.store') }}" id="patientForm">
            @csrf

            <div class="patient-form-layout">

                {{-- =========================================
                     FORMULARIO PRINCIPAL
                     ========================================= --}}
                @include('patients.partials.create-form')

                {{-- =========================================
                     PANEL DERECHO (vista previa)
                     ========================================= --}}
                @include('patients.partials.create-sidebar')

            </div>

        </form>

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

    @vite(['resources/js/pages/patients-create.js'])

@stop
