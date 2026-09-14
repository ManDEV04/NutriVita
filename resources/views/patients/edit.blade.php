@extends('adminlte::page')

@section('title', 'Editar paciente | NutriAdmin')


{{-- =========================================================
     CONTENT HEADER
     ========================================================= --}}
@section('content_header')

    <div class="edit-header">

        <div>
            <span class="header-eyebrow">
                <i class="fas fa-leaf mr-1"></i>
                NUTRIADMIN · EXPEDIENTE
            </span>

            <h1>Editar paciente</h1>

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

    <div class="edit-patient-page">

        <div class="ambient ambient-one"></div>
        <div class="ambient ambient-two"></div>

        <form method="POST" action="{{ route('pacientes.update', $paciente) }}">
            @csrf
            @method('PUT')

            <div class="edit-layout">

                {{-- =========================================
                     FORMULARIO
                     ========================================= --}}
                @include('patients.partials.edit-form')

                {{-- =========================================
                     PREVIEW
                     ========================================= --}}
                @include('patients.partials.edit-preview')

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

    @vite(['resources/js/pages/patients-edit.js'])

@stop
