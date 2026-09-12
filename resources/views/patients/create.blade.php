@extends('adminlte::page')

@section('title', 'Nuevo paciente | NutriAdmin')


@section('content_header')

<div class="patient-form-header">

    <div>

        <span class="header-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN
        </span>

        <h1>
            Nuevo paciente
        </h1>

        <p>
            Registra la información general del paciente.
        </p>

    </div>


    <a
        href="{{ route('pacientes.index') }}"
        class="btn-liquid-secondary"
    >

        <i class="fas fa-arrow-left"></i>

        <span>
            Regresar
        </span>

    </a>

</div>

@stop



@section('content')

<div class="nutri-patient-form-page">


    {{-- LUCES AMBIENTALES --}}
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>
    <div class="ambient ambient-three"></div>



    <form
        method="POST"
        action="{{ route('pacientes.store') }}"
        id="patientForm"
    >

        @csrf


        <div class="patient-form-layout">


            {{-- ==================================================
                 FORMULARIO PRINCIPAL
            =================================================== --}}
            <div class="form-glass-card">


                <div class="glass-shine"></div>


                {{-- ENCABEZADO --}}
                <div class="form-card-header">


                    <div class="form-heading">


                        <div class="form-heading-icon">

                            <i class="far fa-user"></i>

                        </div>


                        <div>

                            <span>
                                INFORMACIÓN PERSONAL
                            </span>

                            <h3>
                                Datos del paciente
                            </h3>

                            <p>
                                Completa la información básica para crear
                                su expediente dentro de NutriAdmin.
                            </p>

                        </div>

                    </div>


                    <div class="required-badge">

                        <span>*</span>
                        Campos obligatorios

                    </div>

                </div>



                {{-- ==================================================
                     NOMBRE
                =================================================== --}}
                <div class="form-section">

                    <div class="section-label">

                        <span class="section-number">
                            01
                        </span>

                        <div>

                            <h4>
                                Identificación
                            </h4>

                            <p>
                                Información principal del paciente.
                            </p>

                        </div>

                    </div>


                    <div class="row">


                        {{-- NOMBRE --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="first_name">

                                    Nombre
                                    <span class="required">*</span>

                                </label>


                                <div class="liquid-input @error('first_name') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="far fa-user"></i>
                                    </div>

                                    <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        value="{{ old('first_name') }}"
                                        placeholder="Ej. Juan"
                                        required
                                        autocomplete="given-name"
                                    >

                                </div>


                                @error('first_name')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- APELLIDOS --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="last_name">

                                    Apellidos
                                    <span class="required">*</span>

                                </label>


                                <div class="liquid-input @error('last_name') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="fas fa-signature"></i>
                                    </div>

                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        value="{{ old('last_name') }}"
                                        placeholder="Ej. García Lizaola"
                                        required
                                        autocomplete="family-name"
                                    >

                                </div>


                                @error('last_name')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- FECHA NACIMIENTO --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="birth_date">
                                    Fecha de nacimiento
                                </label>


                                <div class="liquid-input @error('birth_date') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="far fa-calendar"></i>
                                    </div>

                                    <input
                                        type="date"
                                        id="birth_date"
                                        name="birth_date"
                                        value="{{ old('birth_date') }}"
                                    >

                                </div>


                                @error('birth_date')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- SEXO --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="sex">
                                    Sexo
                                </label>


                                <div class="liquid-input liquid-select @error('sex') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="fas fa-venus-mars"></i>
                                    </div>


                                    <select
                                        id="sex"
                                        name="sex"
                                    >

                                        <option value="">
                                            Selecciona
                                        </option>

                                        <option
                                            value="Masculino"
                                            {{ old('sex') === 'Masculino' ? 'selected' : '' }}
                                        >
                                            Masculino
                                        </option>

                                        <option
                                            value="Femenino"
                                            {{ old('sex') === 'Femenino' ? 'selected' : '' }}
                                        >
                                            Femenino
                                        </option>

                                        <option
                                            value="Otro"
                                            {{ old('sex') === 'Otro' ? 'selected' : '' }}
                                        >
                                            Otro
                                        </option>

                                    </select>

                                </div>


                                @error('sex')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- TELÉFONO --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="phone">
                                    Teléfono
                                </label>


                                <div class="liquid-input @error('phone') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>

                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        placeholder="33 1234 5678"
                                        autocomplete="tel"
                                    >

                                </div>


                                @error('phone')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>



                {{-- ==================================================
                     CONTACTO
                =================================================== --}}
                <div class="form-section">

                    <div class="section-label">

                        <span class="section-number">
                            02
                        </span>

                        <div>

                            <h4>
                                Contacto y actividad
                            </h4>

                            <p>
                                Datos útiles para mantener comunicación.
                            </p>

                        </div>

                    </div>


                    <div class="row">


                        {{-- CORREO --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">
                                    Correo electrónico
                                </label>


                                <div class="liquid-input @error('email') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="paciente@correo.com"
                                        autocomplete="email"
                                    >

                                </div>


                                @error('email')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- OCUPACIÓN --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="occupation">
                                    Ocupación
                                </label>


                                <div class="liquid-input @error('occupation') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>

                                    <input
                                        type="text"
                                        id="occupation"
                                        name="occupation"
                                        value="{{ old('occupation') }}"
                                        placeholder="Ej. Estudiante"
                                    >

                                </div>


                                @error('occupation')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>



                {{-- ==================================================
                     OBJETIVO
                =================================================== --}}
                <div class="form-section last-section">

                    <div class="section-label">

                        <span class="section-number">
                            03
                        </span>

                        <div>

                            <h4>
                                Objetivo nutricional
                            </h4>

                            <p>
                                Describe brevemente qué desea conseguir.
                            </p>

                        </div>

                    </div>


                    <div class="form-group mb-0">

                        <label for="goal">
                            Objetivo del paciente
                        </label>


                        <div class="liquid-textarea @error('goal') input-error @enderror">

                            <div class="textarea-icon">

                                <i class="fas fa-bullseye"></i>

                            </div>


                            <textarea
                                id="goal"
                                name="goal"
                                rows="5"
                                maxlength="1000"
                                placeholder="Ej. Pérdida de grasa manteniendo masa muscular..."
                            >{{ old('goal') }}</textarea>


                            <div class="character-counter">

                                <span id="goalCount">
                                    {{ strlen(old('goal', '')) }}
                                </span>

                                / 1000

                            </div>

                        </div>


                        @error('goal')

                            <div class="field-error">

                                <i class="fas fa-exclamation-circle"></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>



                {{-- ==================================================
                     BOTONES
                =================================================== --}}
                <div class="form-actions">


                    <a
                        href="{{ route('pacientes.index') }}"
                        class="btn-cancel-liquid"
                    >

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn-save-liquid"
                    >

                        <span class="save-text">

                            <i class="far fa-save"></i>

                            Guardar paciente

                        </span>


                        <span class="save-arrow">

                            <i class="fas fa-arrow-right"></i>

                        </span>

                    </button>

                </div>


            </div>




            {{-- ==================================================
                 PANEL DERECHO
            =================================================== --}}
            <div class="patient-side-panel">


                {{-- PERFIL --}}
                <div class="profile-preview-glass">


                    <div class="profile-shine"></div>


                    <span class="side-eyebrow">
                        NUEVO EXPEDIENTE
                    </span>


                    <div class="preview-avatar">

                        <span id="previewInitial">
                            N
                        </span>

                    </div>


                    <h3 id="previewName">
                        Nuevo paciente
                    </h3>


                    <p id="previewOccupation">
                        Información pendiente
                    </p>


                    <div class="preview-status">

                        <span></span>

                        Se registrará como activo

                    </div>


                    <div class="preview-divider"></div>


                    <div class="preview-info">


                        <div>

                            <div class="preview-info-icon">

                                <i class="fas fa-phone-alt"></i>

                            </div>

                            <span id="previewPhone">
                                Sin teléfono
                            </span>

                        </div>


                        <div>

                            <div class="preview-info-icon">

                                <i class="far fa-envelope"></i>

                            </div>

                            <span id="previewEmail">
                                Sin correo
                            </span>

                        </div>


                        <div>

                            <div class="preview-info-icon">

                                <i class="fas fa-bullseye"></i>

                            </div>

                            <span id="previewGoal">
                                Sin objetivo
                            </span>

                        </div>


                    </div>


                </div>



                {{-- INFORMACIÓN --}}
                <div class="side-info-glass">


                    <div class="side-info-header">

                        <div class="side-info-icon">

                            <i class="fas fa-seedling"></i>

                        </div>


                        <div>

                            <span>
                                NUTRIADMIN TIP
                            </span>

                            <h4>
                                Expediente completo
                            </h4>

                        </div>

                    </div>


                    <p>

                        Mientras más información registres desde el inicio,
                        más fácil será llevar el seguimiento del paciente.

                    </p>


                    <div class="tip-list">


                        <div>

                            <i class="fas fa-check"></i>

                            Datos personales

                        </div>


                        <div>

                            <i class="fas fa-check"></i>

                            Información de contacto

                        </div>


                        <div>

                            <i class="fas fa-check"></i>

                            Objetivo nutricional

                        </div>


                    </div>

                </div>



                {{-- SEGURIDAD --}}
                <div class="security-glass">

                    <div>

                        <i class="fas fa-shield-alt"></i>

                    </div>


                    <p>

                        <strong>
                            Información privada
                        </strong>

                        Los datos estarán vinculados
                        únicamente a tu cuenta.

                    </p>

                </div>


            </div>

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


.nutri-patient-form-page {

    position: relative;

    min-height: 850px;

    padding-bottom: 45px;

}



/* =========================================================
   HEADER
========================================================= */

.patient-form-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding-top: 7px;

}


.header-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: #8eb49a;

    font-size: 9px;

    font-weight: 600;

    letter-spacing: 2px;

}


.patient-form-header h1 {

    margin: 0;

    color: #f3faf5;

    font-size: 30px;

    font-weight: 500;

    letter-spacing: -.7px;

}


.patient-form-header p {

    margin: 6px 0 0;

    color: rgba(216,234,220,.47);

    font-size: 12px;

}



/* =========================================================
   BOTÓN REGRESAR
========================================================= */

.btn-liquid-secondary {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 10px 16px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.11);

    background: rgba(255,255,255,.045);

    backdrop-filter: blur(18px);

    color: rgba(228,240,230,.68) !important;

    font-size: 10px;

    text-decoration: none !important;

    transition: .2s;

}


.btn-liquid-secondary:hover {

    background: rgba(151,195,145,.10);

    border-color: rgba(170,208,162,.19);

    color: #dff0df !important;

    transform: translateY(-2px);

}



/* =========================================================
   AMBIENTE
========================================================= */

.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(100px);

    opacity: .18;

}


.ambient-one {

    width: 330px;

    height: 330px;

    right: 2%;

    top: 150px;

    background: #5b9163;

}


.ambient-two {

    width: 300px;

    height: 300px;

    bottom: 3%;

    left: 18%;

    background: #315e43;

}


.ambient-three {

    width: 180px;

    height: 180px;

    top: 570px;

    left: 3%;

    background: #8bb679;

    opacity: .08;

}



/* =========================================================
   LAYOUT
========================================================= */

.patient-form-layout {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        minmax(0, 1.55fr)
        minmax(270px, .55fr);

    gap: 18px;

}



/* =========================================================
   CARD PRINCIPAL
========================================================= */

.form-glass-card {

    position: relative;

    overflow: hidden;

    border-radius: 27px;

    border: 1px solid rgba(255,255,255,.11);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.082),
            rgba(255,255,255,.02)
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

    left: 16%;

    border-radius: 50%;

    background: rgba(255,255,255,.06);

    filter: blur(20px);

}



/* =========================================================
   HEADER CARD
========================================================= */

.form-card-header {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding: 27px 28px;

    border-bottom:
        1px solid rgba(255,255,255,.065);

}


.form-heading {

    display: flex;

    align-items: center;

    gap: 15px;

}


.form-heading-icon {

    width: 52px;

    height: 52px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 17px;

    border: 1px solid rgba(255,255,255,.12);

    background: rgba(143,187,137,.10);

    color: #a3c99a;

    font-size: 17px;

}


.form-heading span {

    display: block;

    color: rgba(182,210,187,.38);

    font-size: 7px;

    letter-spacing: 1.5px;

}


.form-heading h3 {

    margin: 3px 0;

    color: #f0f8f2;

    font-size: 18px;

    font-weight: 500;

}


.form-heading p {

    margin: 0;

    color: rgba(211,229,215,.36);

    font-size: 8px;

}


.required-badge {

    padding: 7px 10px;

    border-radius: 11px;

    border: 1px solid rgba(255,255,255,.07);

    background: rgba(255,255,255,.03);

    color: rgba(215,231,218,.33);

    font-size: 7px;

    white-space: nowrap;

}


.required-badge span,
.required {

    color: #a9ca9e;

}



/* =========================================================
   SECCIONES
========================================================= */

.form-section {

    position: relative;

    z-index: 2;

    padding: 27px 28px 9px;

    border-bottom:
        1px solid rgba(255,255,255,.055);

}


.last-section {

    padding-bottom: 28px;

    border-bottom: none;

}


.section-label {

    display: flex;

    align-items: center;

    gap: 11px;

    margin-bottom: 22px;

}


.section-number {

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: rgba(145,187,139,.08);

    color: #99bd93;

    font-size: 8px;

    font-weight: 600;

}


.section-label h4 {

    margin: 0;

    color: rgba(238,247,240,.82);

    font-size: 12px;

    font-weight: 500;

}


.section-label p {

    margin: 2px 0 0;

    color: rgba(207,226,211,.29);

    font-size: 7px;

}



/* =========================================================
   FORM GROUP
========================================================= */

.form-group {

    margin-bottom: 20px;

}


.form-group label {

    display: block;

    margin-bottom: 8px;

    color: rgba(224,238,226,.58);

    font-size: 9px;

    font-weight: 400;

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

    border:
        1px solid rgba(255,255,255,.095);

    background:
        rgba(255,255,255,.035);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.055);

    transition: .22s;

}


.liquid-input:focus-within {

    border-color:
        rgba(159,201,153,.27);

    background:
        rgba(255,255,255,.055);

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

    color:
        rgba(158,193,161,.46);

    font-size: 11px;

}


.liquid-input input,
.liquid-input select {

    width: 100%;

    height: 100%;

    min-width: 0;

    padding-right: 13px;

    border: none;

    outline: none;

    background: transparent;

    color: #edf7ef;

    font-family: 'Poppins', sans-serif;

    font-size: 10px;

}


.liquid-input input::placeholder {

    color:
        rgba(204,224,208,.23);

}


.liquid-input input[type="date"] {

    color-scheme: dark;

}


.liquid-select select {

    cursor: pointer;

}


.liquid-select select option {

    background: #13291c;

    color: #eef7f0;

}



/* =========================================================
   TEXTAREA
========================================================= */

.liquid-textarea {

    position: relative;

    min-height: 145px;

    display: flex;

    align-items: flex-start;

    border-radius: 17px;

    border:
        1px solid rgba(255,255,255,.095);

    background:
        rgba(255,255,255,.035);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.055);

    transition: .22s;

}


.liquid-textarea:focus-within {

    border-color:
        rgba(159,201,153,.27);

    background:
        rgba(255,255,255,.055);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.07),

        0 0 0 4px rgba(122,175,120,.045);

}


.textarea-icon {

    width: 45px;

    padding-top: 17px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    color:
        rgba(158,193,161,.46);

    font-size: 11px;

}


.liquid-textarea textarea {

    width: 100%;

    min-height: 140px;

    resize: vertical;

    padding: 16px 48px 25px 0;

    border: none;

    outline: none;

    background: transparent;

    color: #edf7ef;

    font-family: 'Poppins', sans-serif;

    font-size: 10px;

    line-height: 1.6;

}


.liquid-textarea textarea::placeholder {

    color:
        rgba(204,224,208,.23);

}


.character-counter {

    position: absolute;

    right: 13px;

    bottom: 9px;

    color:
        rgba(211,229,215,.26);

    font-size: 7px;

}



/* =========================================================
   ERROR
========================================================= */

.input-error {

    border-color:
        rgba(213,101,101,.34) !important;

}


.field-error {

    display: flex;

    align-items: center;

    gap: 5px;

    margin-top: 6px;

    color: #d88686;

    font-size: 8px;

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

    gap: 10px;

    padding: 20px 28px;

    border-top:
        1px solid rgba(255,255,255,.055);

    background:
        rgba(255,255,255,.015);

}


.btn-cancel-liquid {

    height: 45px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding: 0 18px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.08);

    background: rgba(255,255,255,.035);

    color: rgba(220,235,223,.47) !important;

    font-size: 9px;

    text-decoration: none !important;

    transition: .2s;

}


.btn-cancel-liquid:hover {

    background: rgba(255,255,255,.065);

    color: #e8f4ea !important;

}


.btn-save-liquid {

    position: relative;

    overflow: hidden;

    height: 45px;

    min-width: 180px;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 0 49px 0 18px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.22);

    background:

        linear-gradient(
            135deg,
            #add0a1,
            #77a878
        );

    color: #102318;

    font-family: 'Poppins', sans-serif;

    font-size: 9px;

    font-weight: 600;

    cursor: pointer;

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.55),

        0 12px 28px rgba(70,135,84,.19);

    transition: .25s;

}


.btn-save-liquid::before {

    content: "";

    position: absolute;

    width: 35%;

    height: 220%;

    top: -60%;

    left: -60%;

    transform: rotate(25deg);

    background:

        linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.40),
            transparent
        );

    transition: .5s;

}


.btn-save-liquid:hover {

    transform: translateY(-2px);

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.60),

        0 16px 33px rgba(70,135,84,.27);

}


.btn-save-liquid:hover::before {

    left: 125%;

}


.save-text {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 7px;

}


.save-arrow {

    position: absolute;

    z-index: 2;

    right: 7px;

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background:
        rgba(17,48,24,.10);

    transition: .2s;

}


.btn-save-liquid:hover .save-arrow {

    transform: translateX(2px);

}



/* =========================================================
   SIDE PANEL
========================================================= */

.patient-side-panel {

    display: flex;

    flex-direction: column;

    gap: 16px;

}



/* =========================================================
   PREVIEW
========================================================= */

.profile-preview-glass {

    position: relative;

    overflow: hidden;

    padding: 25px 21px;

    border-radius: 25px;

    border:
        1px solid rgba(255,255,255,.105);

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


.profile-preview-glass::after {

    content: "";

    position: absolute;

    width: 150px;

    height: 150px;

    right: -80px;

    bottom: -80px;

    border-radius: 50%;

    background:
        rgba(139,183,134,.09);

}


.profile-shine {

    position: absolute;

    width: 220px;

    height: 90px;

    left: 30px;

    top: -65px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.055);

    filter: blur(15px);

}


.side-eyebrow {

    position: relative;

    z-index: 2;

    display: block;

    color:
        rgba(178,207,183,.36);

    font-size: 7px;

    letter-spacing: 1.5px;

}


.preview-avatar {

    position: relative;

    z-index: 2;

    width: 76px;

    height: 76px;

    margin: 23px auto 14px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 24px;

    border:
        1px solid rgba(255,255,255,.16);

    background:

        linear-gradient(
            145deg,
            rgba(171,208,160,.22),
            rgba(255,255,255,.045)
        );

    color: #b4d4aa;

    font-size: 25px;

    font-weight: 600;

    box-shadow:
        inset 0 1px 1px rgba(255,255,255,.12);

}


.profile-preview-glass h3 {

    position: relative;

    z-index: 2;

    margin: 0;

    text-align: center;

    color: #eff8f1;

    font-size: 16px;

    font-weight: 500;

}


.profile-preview-glass > p {

    position: relative;

    z-index: 2;

    margin: 4px 0 0;

    text-align: center;

    color:
        rgba(211,229,214,.37);

    font-size: 8px;

}


.preview-status {

    position: relative;

    z-index: 2;

    width: fit-content;

    display: flex;

    align-items: center;

    gap: 6px;

    margin: 12px auto 0;

    padding: 6px 9px;

    border-radius: 20px;

    background:
        rgba(91,164,103,.08);

    color: #97ca9f;

    font-size: 7px;

}


.preview-status > span {

    width: 5px;

    height: 5px;

    border-radius: 50%;

    background: #8cd296;

    box-shadow:
        0 0 7px
        rgba(140,210,150,.55);

}


.preview-divider {

    position: relative;

    z-index: 2;

    height: 1px;

    margin: 20px 0;

    background:
        rgba(255,255,255,.055);

}


.preview-info {

    position: relative;

    z-index: 2;

}


.preview-info > div {

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 8px 0;

}


.preview-info-icon {

    width: 30px;

    height: 30px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background:
        rgba(143,187,137,.07);

    color: #8fb28b;

    font-size: 9px;

}


.preview-info span {

    min-width: 0;

    overflow: hidden;

    color:
        rgba(216,231,219,.42);

    font-size: 8px;

    white-space: nowrap;

    text-overflow: ellipsis;

}



/* =========================================================
   TIP
========================================================= */

.side-info-glass {

    padding: 20px;

    border-radius: 21px;

    border:
        1px solid rgba(255,255,255,.09);

    background:
        rgba(255,255,255,.035);

    backdrop-filter: blur(20px);

}


.side-info-header {

    display: flex;

    align-items: center;

    gap: 10px;

}


.side-info-icon {

    width: 39px;

    height: 39px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(143,187,137,.09);

    color: #9fc298;

}


.side-info-header span {

    display: block;

    color:
        rgba(181,209,186,.34);

    font-size: 6px;

    letter-spacing: 1.3px;

}


.side-info-header h4 {

    margin: 2px 0 0;

    color: #eaf5ec;

    font-size: 11px;

}


.side-info-glass > p {

    margin: 15px 0;

    color:
        rgba(211,228,214,.35);

    font-size: 8px;

    line-height: 1.65;

}


.tip-list {

    display: flex;

    flex-direction: column;

    gap: 8px;

}


.tip-list div {

    color:
        rgba(218,234,221,.46);

    font-size: 8px;

}


.tip-list i {

    width: 18px;

    height: 18px;

    margin-right: 5px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 6px;

    background:
        rgba(117,176,121,.08);

    color: #91be95;

    font-size: 6px;

}



/* =========================================================
   SECURITY
========================================================= */

.security-glass {

    display: flex;

    align-items: flex-start;

    gap: 10px;

    padding: 15px;

    border-radius: 18px;

    border:
        1px solid rgba(255,255,255,.07);

    background:
        rgba(255,255,255,.025);

}


.security-glass > div {

    width: 32px;

    height: 32px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background:
        rgba(137,181,133,.07);

    color: #8fad8c;

    font-size: 9px;

}


.security-glass p {

    margin: 0;

    color:
        rgba(205,224,209,.31);

    font-size: 7px;

    line-height: 1.55;

}


.security-glass strong {

    display: block;

    margin-bottom: 2px;

    color:
        rgba(231,241,233,.59);

    font-size: 8px;

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 1050px) {

    .patient-form-layout {

        grid-template-columns: 1fr;

    }


    .patient-side-panel {

        display: grid;

        grid-template-columns:
            1fr
            1fr;

    }


    .profile-preview-glass {

        grid-row: span 2;

    }

}


@media(max-width: 767px) {

    .patient-form-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .form-card-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .required-badge {

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


    .form-card-header {

        padding:
            23px
            19px;

    }


    .form-actions {

        padding:
            17px
            19px;

    }


    .patient-side-panel {

        display: flex;

        flex-direction: column;

    }

}


@media(max-width: 500px) {

    .form-heading {

        align-items: flex-start;

    }


    .form-heading-icon {

        width: 44px;

        height: 44px;

        border-radius: 14px;

    }


    .form-actions {

        align-items: stretch;

        flex-direction: column-reverse;

    }


    .btn-save-liquid,
    .btn-cancel-liquid {

        width: 100%;

    }

}

</style>

@stop



@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const firstName =
        document.getElementById('first_name');

    const lastName =
        document.getElementById('last_name');

    const occupation =
        document.getElementById('occupation');

    const phone =
        document.getElementById('phone');

    const email =
        document.getElementById('email');

    const goal =
        document.getElementById('goal');


    const previewName =
        document.getElementById('previewName');

    const previewInitial =
        document.getElementById('previewInitial');

    const previewOccupation =
        document.getElementById('previewOccupation');

    const previewPhone =
        document.getElementById('previewPhone');

    const previewEmail =
        document.getElementById('previewEmail');

    const previewGoal =
        document.getElementById('previewGoal');

    const goalCount =
        document.getElementById('goalCount');



    function updatePreview() {

        const name =
            firstName.value.trim();

        const lastname =
            lastName.value.trim();


        const fullName =
            (name + ' ' + lastname).trim();


        previewName.textContent =
            fullName || 'Nuevo paciente';


        previewInitial.textContent =
            name
                ? name.charAt(0).toUpperCase()
                : 'N';


        previewOccupation.textContent =
            occupation.value.trim()
                || 'Información pendiente';


        previewPhone.textContent =
            phone.value.trim()
                || 'Sin teléfono';


        previewEmail.textContent =
            email.value.trim()
                || 'Sin correo';


        previewGoal.textContent =
            goal.value.trim()
                || 'Sin objetivo';


        goalCount.textContent =
            goal.value.length;

    }



    [
        firstName,
        lastName,
        occupation,
        phone,
        email,
        goal

    ].forEach(function (field) {

        field.addEventListener(
            'input',
            updatePreview
        );

    });


    updatePreview();

});

</script>

@stop