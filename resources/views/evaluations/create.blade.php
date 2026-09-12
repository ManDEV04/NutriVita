@extends('adminlte::page')

@section('title', 'Nueva evaluación | NutriAdmin')


@section('content_header')

<div class="evaluation-page-header">

    <div>

        <span class="header-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN · SEGUIMIENTO
        </span>

        <h1>
            Nueva evaluación
        </h1>

        <p>
            {{ $paciente->first_name }}
            {{ $paciente->last_name }}
        </p>

    </div>


    <a
        href="{{ route('pacientes.show', $paciente) }}"
        class="btn-liquid-secondary"
    >

        <i class="fas fa-arrow-left"></i>

        Regresar

    </a>

</div>

@stop



@section('content')

@php

    $measurements = [

        'waist' => [
            'label' => 'Cintura',
            'icon' => 'fa-ruler-horizontal'
        ],

        'hip' => [
            'label' => 'Cadera',
            'icon' => 'fa-ruler'
        ],

        'chest' => [
            'label' => 'Pecho',
            'icon' => 'fa-expand'
        ],

        'arm' => [
            'label' => 'Brazo',
            'icon' => 'fa-dumbbell'
        ],

        'thigh' => [
            'label' => 'Muslo',
            'icon' => 'fa-ruler-combined'
        ],

    ];

@endphp


<div class="evaluation-page">


    {{-- LUCES AMBIENTALES --}}
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>
    <div class="ambient ambient-three"></div>



    <form
        method="POST"
        action="{{ route('evaluaciones.store', $paciente) }}"
        id="evaluationForm"
    >

        @csrf


        <div class="evaluation-layout">


            {{-- =====================================================
                 FORMULARIO
            ====================================================== --}}

            <div class="evaluation-form-glass">


                <div class="glass-shine"></div>



                {{-- HEADER --}}
                <div class="form-main-header">


                    <div class="heading-main">


                        <div class="heading-icon">

                            <i class="fas fa-clipboard-check"></i>

                        </div>


                        <div>

                            <span>
                                EVALUACIÓN NUTRICIONAL
                            </span>

                            <h3>
                                Datos antropométricos
                            </h3>

                            <p>
                                Registra las mediciones actuales del paciente.
                            </p>

                        </div>


                    </div>



                    <div class="patient-mini-badge">

                        <div class="mini-avatar">

                            {{ strtoupper(substr($paciente->first_name, 0, 1)) }}
                            {{ strtoupper(substr($paciente->last_name, 0, 1)) }}

                        </div>

                        <div>

                            <span>
                                PACIENTE
                            </span>

                            <strong>

                                {{ $paciente->first_name }}
                                {{ $paciente->last_name }}

                            </strong>

                        </div>

                    </div>


                </div>



                {{-- =====================================================
                     01 COMPOSICIÓN CORPORAL
                ====================================================== --}}

                <div class="form-section">


                    <div class="section-heading">


                        <span class="section-number">
                            01
                        </span>


                        <div>

                            <h4>
                                Composición corporal
                            </h4>

                            <p>
                                Datos principales de la evaluación.
                            </p>

                        </div>


                    </div>



                    <div class="row">


                        {{-- FECHA --}}
                        <div class="col-lg-4 col-md-6">

                            <div class="form-group">


                                <label for="evaluation_date">

                                    Fecha

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="liquid-input @error('evaluation_date') input-error @enderror">

                                    <div class="input-icon">

                                        <i class="far fa-calendar-alt"></i>

                                    </div>


                                    <input
                                        type="date"
                                        id="evaluation_date"
                                        name="evaluation_date"
                                        value="{{ old('evaluation_date', now()->format('Y-m-d')) }}"
                                        required
                                    >

                                </div>


                                @error('evaluation_date')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        </div>



                        {{-- PESO --}}
                        <div class="col-lg-4 col-md-6">

                            <div class="form-group">


                                <label for="weight">

                                    Peso

                                    <span class="input-unit-label">
                                        kg
                                    </span>

                                </label>


                                <div class="liquid-input @error('weight') input-error @enderror">

                                    <div class="input-icon">

                                        <i class="fas fa-weight"></i>

                                    </div>


                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="weight"
                                        name="weight"
                                        value="{{ old('weight') }}"
                                        placeholder="Ej. 82.50"
                                    >

                                    <span class="input-suffix">
                                        kg
                                    </span>

                                </div>


                                @error('weight')

                                    <div class="field-error">

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        </div>



                        {{-- ESTATURA --}}
                        <div class="col-lg-4 col-md-6">

                            <div class="form-group">


                                <label for="height">

                                    Estatura

                                    <span class="input-unit-label">
                                        cm
                                    </span>

                                </label>


                                <div class="liquid-input @error('height') input-error @enderror">

                                    <div class="input-icon">

                                        <i class="fas fa-ruler-vertical"></i>

                                    </div>


                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="height"
                                        name="height"
                                        value="{{ old('height') }}"
                                        placeholder="Ej. 178"
                                    >

                                    <span class="input-suffix">
                                        cm
                                    </span>

                                </div>


                                @error('height')

                                    <div class="field-error">

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        </div>



                        {{-- GRASA --}}
                        <div class="col-lg-6 col-md-6">

                            <div class="form-group">


                                <label for="body_fat">

                                    Grasa corporal

                                    <span class="input-unit-label">
                                        %
                                    </span>

                                </label>


                                <div class="liquid-input @error('body_fat') input-error @enderror">

                                    <div class="input-icon">

                                        <i class="fas fa-percentage"></i>

                                    </div>


                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="body_fat"
                                        name="body_fat"
                                        value="{{ old('body_fat') }}"
                                        placeholder="Ej. 18.5"
                                    >

                                    <span class="input-suffix">
                                        %
                                    </span>

                                </div>


                                @error('body_fat')

                                    <div class="field-error">

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        </div>



                        {{-- MÚSCULO --}}
                        <div class="col-lg-6 col-md-6">

                            <div class="form-group">


                                <label for="muscle_mass">

                                    Masa muscular

                                    <span class="input-unit-label">
                                        kg
                                    </span>

                                </label>


                                <div class="liquid-input @error('muscle_mass') input-error @enderror">

                                    <div class="input-icon">

                                        <i class="fas fa-dumbbell"></i>

                                    </div>


                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="muscle_mass"
                                        name="muscle_mass"
                                        value="{{ old('muscle_mass') }}"
                                        placeholder="Ej. 35.20"
                                    >

                                    <span class="input-suffix">
                                        kg
                                    </span>

                                </div>


                                @error('muscle_mass')

                                    <div class="field-error">

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        </div>


                    </div>

                </div>



                {{-- =====================================================
                     02 MEDIDAS
                ====================================================== --}}

                <div class="form-section">


                    <div class="section-heading">


                        <span class="section-number">
                            02
                        </span>


                        <div>

                            <h4>
                                Medidas corporales
                            </h4>

                            <p>
                                Registra perímetros para comparar el progreso.
                            </p>

                        </div>


                    </div>



                    <div class="measurements-grid">


                        @foreach($measurements as $name => $data)

                            <div class="measurement-field">


                                <label for="{{ $name }}">

                                    {{ $data['label'] }}

                                </label>


                                <div class="liquid-input measurement-input @error($name) input-error @enderror">


                                    <div class="input-icon">

                                        <i class="fas {{ $data['icon'] }}"></i>

                                    </div>


                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="{{ $name }}"
                                        name="{{ $name }}"
                                        value="{{ old($name) }}"
                                        placeholder="0.00"
                                    >


                                    <span class="input-suffix">
                                        cm
                                    </span>


                                </div>


                                @error($name)

                                    <div class="field-error">

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        @endforeach


                    </div>

                </div>



                {{-- =====================================================
                     03 OBSERVACIONES
                ====================================================== --}}

                <div class="form-section last-section">


                    <div class="section-heading">


                        <span class="section-number">
                            03
                        </span>


                        <div>

                            <h4>
                                Observaciones
                            </h4>

                            <p>
                                Añade notas relevantes de la consulta.
                            </p>

                        </div>


                    </div>



                    <div class="form-group mb-0">


                        <div class="liquid-textarea @error('notes') input-error @enderror">


                            <div class="textarea-icon">

                                <i class="far fa-clipboard"></i>

                            </div>


                            <textarea
                                name="notes"
                                id="notes"
                                rows="5"
                                placeholder="Ej. El paciente reporta buena adherencia al plan, mejora en energía y entrenamiento..."
                            >{{ old('notes') }}</textarea>


                            <div class="notes-counter">

                                <span id="notesCount">
                                    {{ strlen(old('notes', '')) }}
                                </span>

                                caracteres

                            </div>


                        </div>


                        @error('notes')

                            <div class="field-error">

                                {{ $message }}

                            </div>

                        @enderror


                    </div>


                </div>



                {{-- =====================================================
                     FOOTER
                ====================================================== --}}

                <div class="form-actions">


                    <a
                        href="{{ route('pacientes.show', $paciente) }}"
                        class="btn-cancel-liquid"
                    >

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn-save-liquid"
                    >

                        <span>

                            <i class="far fa-save"></i>

                            Guardar evaluación

                        </span>


                        <div>

                            <i class="fas fa-arrow-right"></i>

                        </div>


                    </button>


                </div>


            </div>



            {{-- =====================================================
                 PANEL DERECHO
            ====================================================== --}}

            <aside class="evaluation-sidebar">


                {{-- RESUMEN EN VIVO --}}
                <div class="live-summary-glass">


                    <div class="side-shine"></div>


                    <div class="live-header">


                        <div>

                            <span>
                                VISTA PREVIA
                            </span>

                            <h4>
                                Evaluación actual
                            </h4>

                        </div>


                        <div class="live-indicator">

                            <span></span>

                            En vivo

                        </div>


                    </div>



                    <div class="live-patient">


                        <div class="live-avatar">

                            {{ strtoupper(substr($paciente->first_name, 0, 1)) }}
                            {{ strtoupper(substr($paciente->last_name, 0, 1)) }}

                        </div>


                        <div>

                            <strong>

                                {{ $paciente->first_name }}
                                {{ $paciente->last_name }}

                            </strong>


                            <span>

                                Nueva medición

                            </span>

                        </div>


                    </div>



                    {{-- IMC --}}
                    <div class="bmi-preview">


                        <div class="bmi-circle">

                            <strong id="previewBmi">
                                —
                            </strong>

                            <span>
                                IMC
                            </span>

                        </div>


                        <div class="bmi-info">

                            <span>
                                ÍNDICE CORPORAL
                            </span>

                            <h4 id="bmiStatus">
                                Esperando datos
                            </h4>

                            <p id="bmiDescription">

                                Ingresa peso y estatura
                                para obtener el cálculo.

                            </p>

                        </div>


                    </div>



                    {{-- VALORES --}}
                    <div class="live-values">


                        <div>

                            <div class="live-value-icon">

                                <i class="fas fa-weight"></i>

                            </div>

                            <span>
                                Peso
                            </span>

                            <strong id="previewWeight">
                                —
                            </strong>

                            <small>
                                kg
                            </small>

                        </div>



                        <div>

                            <div class="live-value-icon">

                                <i class="fas fa-percentage"></i>

                            </div>

                            <span>
                                Grasa
                            </span>

                            <strong id="previewFat">
                                —
                            </strong>

                            <small>
                                %
                            </small>

                        </div>



                        <div>

                            <div class="live-value-icon">

                                <i class="fas fa-dumbbell"></i>

                            </div>

                            <span>
                                Músculo
                            </span>

                            <strong id="previewMuscle">
                                —
                            </strong>

                            <small>
                                kg
                            </small>

                        </div>


                    </div>


                </div>



                {{-- MEDIDAS PREVIEW --}}
                <div class="measure-preview-glass">


                    <div class="side-card-heading">


                        <div>

                            <span>
                                PERÍMETROS
                            </span>

                            <h4>
                                Medidas corporales
                            </h4>

                        </div>


                        <div>

                            <i class="fas fa-ruler-combined"></i>

                        </div>


                    </div>



                    <div class="measure-preview-list">


                        <div>

                            <span>
                                Cintura
                            </span>

                            <strong id="previewWaist">
                                —
                            </strong>

                        </div>


                        <div>

                            <span>
                                Cadera
                            </span>

                            <strong id="previewHip">
                                —
                            </strong>

                        </div>


                        <div>

                            <span>
                                Pecho
                            </span>

                            <strong id="previewChest">
                                —
                            </strong>

                        </div>


                        <div>

                            <span>
                                Brazo
                            </span>

                            <strong id="previewArm">
                                —
                            </strong>

                        </div>


                        <div>

                            <span>
                                Muslo
                            </span>

                            <strong id="previewThigh">
                                —
                            </strong>

                        </div>


                    </div>


                </div>



                {{-- TIP --}}
                <div class="evaluation-tip-glass">


                    <div>

                        <i class="fas fa-seedling"></i>

                    </div>


                    <p>

                        <strong>
                            Seguimiento consistente
                        </strong>

                        Usa condiciones similares en cada medición
                        para obtener comparaciones más útiles.

                    </p>


                </div>


            </aside>


        </div>

    </form>


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


.evaluation-page {

    position: relative;

    min-height: 900px;

    padding-bottom: 45px;

}



/* =========================================================
   HEADER
========================================================= */

.evaluation-page-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

}


.header-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: #8eb49a;

    font-size: 9px;

    font-weight: 600;

    letter-spacing: 2px;

}


.evaluation-page-header h1 {

    margin: 0;

    color: #f3faf5;

    font-size: 30px;

    font-weight: 500;

    letter-spacing: -.7px;

}


.evaluation-page-header p {

    margin: 5px 0 0;

    color: rgba(216,234,220,.44);

    font-size: 11px;

}



/* =========================================================
   BOTÓN REGRESAR
========================================================= */

.btn-liquid-secondary {

    height: 42px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 0 15px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.10);

    background: rgba(255,255,255,.04);

    color: rgba(229,240,231,.61) !important;

    font-size: 9px;

    text-decoration: none !important;

    backdrop-filter: blur(18px);

    transition: .2s;

}


.btn-liquid-secondary:hover {

    transform: translateY(-2px);

    background: rgba(255,255,255,.07);

    color: #eef8f0 !important;

}



/* =========================================================
   AMBIENTE
========================================================= */

.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(105px);

}


.ambient-one {

    width: 350px;

    height: 350px;

    top: 140px;

    right: 2%;

    background: rgba(91,145,99,.20);

}


.ambient-two {

    width: 300px;

    height: 300px;

    bottom: 0;

    left: 18%;

    background: rgba(49,94,67,.20);

}


.ambient-three {

    width: 190px;

    height: 190px;

    top: 620px;

    left: 3%;

    background: rgba(139,182,121,.07);

}



/* =========================================================
   LAYOUT
========================================================= */

.evaluation-layout {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        minmax(0,1.55fr)
        minmax(280px,.55fr);

    gap: 18px;

}



/* =========================================================
   CARD PRINCIPAL
========================================================= */

.evaluation-form-glass {

    position: relative;

    overflow: hidden;

    border-radius: 28px;

    border: 1px solid rgba(255,255,255,.11);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.082),
            rgba(255,255,255,.018)
        );

    backdrop-filter:
        blur(26px)
        saturate(140%);

    -webkit-backdrop-filter:
        blur(26px)
        saturate(140%);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.13),

        0 25px 55px rgba(0,0,0,.16);

}


.glass-shine {

    position: absolute;

    width: 500px;

    height: 160px;

    top: -120px;

    left: 14%;

    border-radius: 50%;

    background: rgba(255,255,255,.06);

    filter: blur(20px);

}



/* =========================================================
   HEADER FORM
========================================================= */

.form-main-header {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding: 26px 28px;

    border-bottom: 1px solid rgba(255,255,255,.06);

}


.heading-main {

    display: flex;

    align-items: center;

    gap: 14px;

}


.heading-icon {

    width: 52px;

    height: 52px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 17px;

    border: 1px solid rgba(255,255,255,.11);

    background: rgba(143,187,137,.09);

    color: #9fc399;

    font-size: 17px;

}


.heading-main span {

    color: rgba(184,211,189,.35);

    font-size: 7px;

    letter-spacing: 1.4px;

}


.heading-main h3 {

    margin: 3px 0;

    color: #eef7f0;

    font-size: 18px;

    font-weight: 500;

}


.heading-main p {

    margin: 0;

    color: rgba(208,228,212,.32);

    font-size: 8px;

}



/* =========================================================
   PACIENTE MINI
========================================================= */

.patient-mini-badge {

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 8px 11px;

    border-radius: 15px;

    border: 1px solid rgba(255,255,255,.07);

    background: rgba(255,255,255,.03);

}


.mini-avatar {

    width: 35px;

    height: 35px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: rgba(146,190,140,.11);

    color: #aecda5;

    font-size: 9px;

    font-weight: 600;

}


.patient-mini-badge span {

    display: block;

    color: rgba(191,216,196,.29);

    font-size: 6px;

    letter-spacing: 1px;

}


.patient-mini-badge strong {

    display: block;

    margin-top: 2px;

    color: rgba(236,246,238,.67);

    font-size: 8px;

    font-weight: 500;

}



/* =========================================================
   SECCIONES
========================================================= */

.form-section {

    position: relative;

    z-index: 2;

    padding: 27px 28px 9px;

    border-bottom: 1px solid rgba(255,255,255,.055);

}


.last-section {

    padding-bottom: 28px;

    border-bottom: none;

}


.section-heading {

    display: flex;

    align-items: center;

    gap: 11px;

    margin-bottom: 21px;

}


.section-number {

    width: 32px;

    height: 32px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: rgba(145,187,139,.08);

    color: #9abe94;

    font-size: 8px;

    font-weight: 600;

}


.section-heading h4 {

    margin: 0;

    color: rgba(239,248,241,.79);

    font-size: 12px;

    font-weight: 500;

}


.section-heading p {

    margin: 2px 0 0;

    color: rgba(207,226,211,.28);

    font-size: 7px;

}



/* =========================================================
   FORM
========================================================= */

.form-group {

    margin-bottom: 20px;

}


.form-group label,
.measurement-field label {

    display: block;

    margin-bottom: 8px;

    color: rgba(224,238,226,.58);

    font-size: 9px;

    font-weight: 400;

}


.required {

    color: #a8cb9d;

}


.input-unit-label {

    margin-left: 4px;

    color: rgba(174,202,180,.27);

    font-size: 7px;

}



/* =========================================================
   INPUTS
========================================================= */

.liquid-input {

    position: relative;

    height: 52px;

    display: flex;

    align-items: center;

    border-radius: 15px;

    border: 1px solid rgba(255,255,255,.095);

    background: rgba(255,255,255,.035);

    box-shadow: inset 0 1px 0 rgba(255,255,255,.055);

    transition: .22s;

}


.liquid-input:focus-within {

    border-color: rgba(159,201,153,.27);

    background: rgba(255,255,255,.055);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.07),

        0 0 0 4px rgba(122,175,120,.045);

}


.input-icon {

    width: 45px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    color: rgba(158,193,161,.46);

    font-size: 11px;

}


.liquid-input input {

    width: 100%;

    height: 100%;

    min-width: 0;

    padding-right: 9px;

    border: none;

    outline: none;

    background: transparent;

    color: #edf7ef;

    font-family: 'Poppins', sans-serif;

    font-size: 10px;

}


.liquid-input input::placeholder {

    color: rgba(204,224,208,.22);

}


.liquid-input input[type="date"] {

    color-scheme: dark;

}


.input-suffix {

    padding-right: 13px;

    color: rgba(201,220,205,.29);

    font-size: 8px;

}



/* =========================================================
   QUITAR FLECHAS NUMBER
========================================================= */

.liquid-input input[type="number"]::-webkit-inner-spin-button,
.liquid-input input[type="number"]::-webkit-outer-spin-button {

    opacity: .25;

}



/* =========================================================
   MEDIDAS
========================================================= */

.measurements-grid {

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0,1fr));

    gap: 0 14px;

}


.measurement-field {

    margin-bottom: 20px;

}



/* =========================================================
   TEXTAREA
========================================================= */

.liquid-textarea {

    position: relative;

    min-height: 150px;

    display: flex;

    align-items: flex-start;

    border-radius: 17px;

    border: 1px solid rgba(255,255,255,.095);

    background: rgba(255,255,255,.035);

    transition: .22s;

}


.liquid-textarea:focus-within {

    border-color: rgba(159,201,153,.27);

    background: rgba(255,255,255,.055);

    box-shadow:
        0 0 0 4px rgba(122,175,120,.045);

}


.textarea-icon {

    width: 45px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    padding-top: 17px;

    color: rgba(158,193,161,.46);

    font-size: 11px;

}


.liquid-textarea textarea {

    width: 100%;

    min-height: 145px;

    resize: vertical;

    padding: 16px 20px 30px 0;

    border: none;

    outline: none;

    background: transparent;

    color: #edf7ef;

    font-family: 'Poppins', sans-serif;

    font-size: 10px;

    line-height: 1.65;

}


.liquid-textarea textarea::placeholder {

    color: rgba(204,224,208,.22);

}


.notes-counter {

    position: absolute;

    right: 13px;

    bottom: 9px;

    color: rgba(204,225,208,.23);

    font-size: 7px;

}



/* =========================================================
   ERRORES
========================================================= */

.input-error {

    border-color: rgba(211,101,101,.33) !important;

}


.field-error {

    margin-top: 5px;

    color: #d58a8a;

    font-size: 7px;

}



/* =========================================================
   ACCIONES
========================================================= */

.form-actions {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: flex-end;

    gap: 9px;

    padding: 20px 28px;

    border-top: 1px solid rgba(255,255,255,.055);

    background: rgba(255,255,255,.013);

}


.btn-cancel-liquid {

    height: 45px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding: 0 18px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.08);

    background: rgba(255,255,255,.03);

    color: rgba(221,236,224,.44) !important;

    font-size: 9px;

    text-decoration: none !important;

}


.btn-save-liquid {

    position: relative;

    overflow: hidden;

    min-width: 195px;

    height: 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 0 49px 0 18px;

    border: 1px solid rgba(255,255,255,.21);

    border-radius: 14px;

    background:

        linear-gradient(
            135deg,
            #acd0a1,
            #76a777
        );

    color: #102318;

    font-family: 'Poppins', sans-serif;

    font-size: 9px;

    font-weight: 600;

    cursor: pointer;

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.53),

        0 12px 28px rgba(70,135,84,.20);

    transition: .24s;

}


.btn-save-liquid > span {

    display: flex;

    align-items: center;

    gap: 7px;

}


.btn-save-liquid > div {

    position: absolute;

    right: 7px;

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: rgba(17,48,24,.10);

}


.btn-save-liquid:hover {

    transform: translateY(-2px);

}



/* =========================================================
   SIDEBAR
========================================================= */

.evaluation-sidebar {

    display: flex;

    flex-direction: column;

    gap: 16px;

}



/* =========================================================
   LIVE SUMMARY
========================================================= */

.live-summary-glass {

    position: relative;

    overflow: hidden;

    padding: 22px;

    border-radius: 25px;

    border: 1px solid rgba(255,255,255,.105);

    background:

        linear-gradient(
            145deg,
            rgba(150,195,145,.10),
            rgba(255,255,255,.022)
        );

    backdrop-filter: blur(24px);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.12),

        0 18px 40px rgba(0,0,0,.12);

}


.side-shine {

    position: absolute;

    width: 220px;

    height: 90px;

    top: -65px;

    left: 25px;

    border-radius: 50%;

    background: rgba(255,255,255,.055);

    filter: blur(15px);

}


.live-header {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

}


.live-header span,
.side-card-heading span {

    display: block;

    color: rgba(182,210,187,.33);

    font-size: 6px;

    letter-spacing: 1.3px;

}


.live-header h4,
.side-card-heading h4 {

    margin: 3px 0 0;

    color: #ecf7ee;

    font-size: 12px;

}


.live-indicator {

    display: flex;

    align-items: center;

    gap: 5px;

    padding: 5px 7px;

    border-radius: 15px;

    background: rgba(84,160,96,.07);

    color: #94c99c;

    font-size: 6px;

}


.live-indicator span {

    width: 5px;

    height: 5px;

    border-radius: 50%;

    background: #8bd195;

    box-shadow: 0 0 7px #8bd195;

}



/* =========================================================
   PACIENTE SIDE
========================================================= */

.live-patient {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 10px;

    margin: 19px 0;

    padding-bottom: 17px;

    border-bottom: 1px solid rgba(255,255,255,.055);

}


.live-avatar {

    width: 40px;

    height: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    border: 1px solid rgba(255,255,255,.10);

    background: rgba(146,190,140,.10);

    color: #afd0a5;

    font-size: 10px;

    font-weight: 600;

}


.live-patient strong {

    display: block;

    color: rgba(238,247,240,.77);

    font-size: 9px;

    font-weight: 500;

}


.live-patient span {

    display: block;

    margin-top: 2px;

    color: rgba(202,222,206,.29);

    font-size: 7px;

}



/* =========================================================
   BMI
========================================================= */

.bmi-preview {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 15px;

    padding-bottom: 18px;

    border-bottom: 1px solid rgba(255,255,255,.055);

}


.bmi-circle {

    width: 82px;

    height: 82px;

    flex-shrink: 0;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    border: 1px solid rgba(170,208,162,.15);

    background:

        radial-gradient(
            circle,
            rgba(150,196,143,.14),
            rgba(255,255,255,.02)
        );

}


.bmi-circle strong {

    color: #edf7ef;

    font-size: 21px;

    font-weight: 500;

}


.bmi-circle span {

    margin-top: 1px;

    color: rgba(183,209,188,.36);

    font-size: 6px;

    letter-spacing: 1px;

}


.bmi-info > span {

    color: rgba(181,210,187,.30);

    font-size: 6px;

    letter-spacing: 1px;

}


.bmi-info h4 {

    margin: 3px 0 4px;

    color: #aacda1;

    font-size: 11px;

}


.bmi-info p {

    margin: 0;

    color: rgba(207,227,211,.31);

    font-size: 7px;

    line-height: 1.55;

}



/* =========================================================
   VALORES
========================================================= */

.live-values {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns: repeat(3,1fr);

    gap: 7px;

    margin-top: 17px;

}


.live-values > div {

    padding: 10px 6px;

    text-align: center;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.055);

    background: rgba(255,255,255,.025);

}


.live-value-icon {

    width: 28px;

    height: 28px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 7px;

    border-radius: 9px;

    background: rgba(142,185,136,.07);

    color: #93b790;

    font-size: 8px;

}


.live-values span {

    display: block;

    color: rgba(198,219,203,.28);

    font-size: 6px;

}


.live-values strong {

    display: inline-block;

    margin-top: 3px;

    color: #edf7ef;

    font-size: 13px;

    font-weight: 500;

}


.live-values small {

    color: rgba(200,220,204,.28);

    font-size: 6px;

}



/* =========================================================
   MEDIDAS PREVIEW
========================================================= */

.measure-preview-glass {

    padding: 20px;

    border-radius: 22px;

    border: 1px solid rgba(255,255,255,.09);

    background: rgba(255,255,255,.032);

    backdrop-filter: blur(20px);

}


.side-card-heading {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 14px;

}


.side-card-heading > div:last-child {

    width: 36px;

    height: 36px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    background: rgba(142,185,136,.08);

    color: #94b790;

    font-size: 9px;

}


.measure-preview-list {

    display: flex;

    flex-direction: column;

}


.measure-preview-list > div {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 9px 2px;

    border-top: 1px solid rgba(255,255,255,.045);

}


.measure-preview-list span {

    color: rgba(208,226,212,.36);

    font-size: 7px;

}


.measure-preview-list strong {

    color: rgba(236,246,238,.68);

    font-size: 8px;

    font-weight: 500;

}


.measure-preview-list strong:not(:empty)::after {

    content: " cm";

    color: rgba(205,224,209,.25);

    font-size: 6px;

}



/* =========================================================
   TIP
========================================================= */

.evaluation-tip-glass {

    display: flex;

    align-items: flex-start;

    gap: 10px;

    padding: 15px;

    border-radius: 18px;

    border: 1px solid rgba(255,255,255,.07);

    background: rgba(255,255,255,.025);

}


.evaluation-tip-glass > div {

    width: 34px;

    height: 34px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: rgba(139,183,134,.07);

    color: #90b18d;

    font-size: 9px;

}


.evaluation-tip-glass p {

    margin: 0;

    color: rgba(207,225,211,.30);

    font-size: 7px;

    line-height: 1.55;

}


.evaluation-tip-glass strong {

    display: block;

    margin-bottom: 2px;

    color: rgba(235,244,237,.59);

    font-size: 8px;

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 1050px) {

    .evaluation-layout {

        grid-template-columns: 1fr;

    }


    .evaluation-sidebar {

        display: grid;

        grid-template-columns:
            1fr
            1fr;

    }


    .evaluation-tip-glass {

        grid-column: 1 / -1;

    }

}


@media(max-width: 767px) {

    .evaluation-page-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .form-main-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .patient-mini-badge {

        display: none;

    }


    .form-section {

        padding:
            24px
            19px
            8px;

    }


    .last-section {

        padding-bottom: 24px;

    }


    .measurements-grid {

        grid-template-columns:
            repeat(2,1fr);

    }


    .evaluation-sidebar {

        display: flex;

    }


    .form-actions {

        padding:
            18px
            19px;

    }

}


@media(max-width: 500px) {

    .measurements-grid {

        grid-template-columns: 1fr;

    }


    .form-actions {

        align-items: stretch;

        flex-direction: column-reverse;

    }


    .btn-cancel-liquid,
    .btn-save-liquid {

        width: 100%;

    }


    .live-values {

        grid-template-columns: 1fr;

    }

}

</style>

@stop



@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {


    const weight =
        document.getElementById('weight');

    const height =
        document.getElementById('height');

    const bodyFat =
        document.getElementById('body_fat');

    const muscle =
        document.getElementById('muscle_mass');

    const notes =
        document.getElementById('notes');


    const waist =
        document.getElementById('waist');

    const hip =
        document.getElementById('hip');

    const chest =
        document.getElementById('chest');

    const arm =
        document.getElementById('arm');

    const thigh =
        document.getElementById('thigh');



    /* =====================================================
       PREVIEW
    ===================================================== */

    function displayValue(value, fallback = '—') {

        return value && value.trim() !== ''
            ? value
            : fallback;

    }



    function updatePreview() {


        document.getElementById('previewWeight')
            .textContent =
            displayValue(weight.value);


        document.getElementById('previewFat')
            .textContent =
            displayValue(bodyFat.value);


        document.getElementById('previewMuscle')
            .textContent =
            displayValue(muscle.value);


        document.getElementById('previewWaist')
            .textContent =
            displayValue(waist.value);


        document.getElementById('previewHip')
            .textContent =
            displayValue(hip.value);


        document.getElementById('previewChest')
            .textContent =
            displayValue(chest.value);


        document.getElementById('previewArm')
            .textContent =
            displayValue(arm.value);


        document.getElementById('previewThigh')
            .textContent =
            displayValue(thigh.value);



        /* ===============================================
           CALCULAR IMC
        =============================================== */

        const weightValue =
            parseFloat(weight.value);

        const heightValue =
            parseFloat(height.value);


        const bmiElement =
            document.getElementById('previewBmi');

        const statusElement =
            document.getElementById('bmiStatus');

        const descriptionElement =
            document.getElementById('bmiDescription');


        if (
            weightValue > 0 &&
            heightValue > 0
        ) {

            const heightMeters =
                heightValue / 100;


            const bmi =
                weightValue /
                (heightMeters * heightMeters);


            const rounded =
                bmi.toFixed(1);


            bmiElement.textContent =
                rounded;



            if (bmi < 18.5) {

                statusElement.textContent =
                    'Bajo peso';

                descriptionElement.textContent =
                    'IMC preliminar calculado con peso y estatura.';

            }

            else if (bmi < 25) {

                statusElement.textContent =
                    'Rango normal';

                descriptionElement.textContent =
                    'IMC preliminar calculado con peso y estatura.';

            }

            else if (bmi < 30) {

                statusElement.textContent =
                    'Sobrepeso';

                descriptionElement.textContent =
                    'IMC preliminar calculado con peso y estatura.';

            }

            else {

                statusElement.textContent =
                    'IMC elevado';

                descriptionElement.textContent =
                    'IMC preliminar calculado con peso y estatura.';

            }

        }

        else {

            bmiElement.textContent =
                '—';

            statusElement.textContent =
                'Esperando datos';

            descriptionElement.textContent =
                'Ingresa peso y estatura para obtener el cálculo.';

        }


    }



    /* =====================================================
       CONTADOR NOTAS
    ===================================================== */

    function updateNotesCounter() {

        const counter =
            document.getElementById('notesCount');


        counter.textContent =
            notes.value.length;

    }



    /* =====================================================
       EVENTOS
    ===================================================== */

    [
        weight,
        height,
        bodyFat,
        muscle,
        waist,
        hip,
        chest,
        arm,
        thigh

    ].forEach(function (input) {

        if (input) {

            input.addEventListener(
                'input',
                updatePreview
            );

        }

    });



    if (notes) {

        notes.addEventListener(
            'input',
            updateNotesCounter
        );

    }



    updatePreview();

    updateNotesCounter();

});

</script>

@stop