@extends('adminlte::page')

@section('title', 'Editar paciente | NutriAdmin')


@section('content_header')

<div class="edit-header">

    <div>

        <span class="header-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN · EXPEDIENTE
        </span>

        <h1>
            Editar paciente
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

<div class="edit-patient-page">

    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>


    <form
        method="POST"
        action="{{ route('pacientes.update', $paciente) }}"
    >

        @csrf

        @method('PUT')


        <div class="edit-layout">


            {{-- ==================================================
                 FORMULARIO
            =================================================== --}}

            <div class="edit-glass-card">


                <div class="glass-shine"></div>


                <div class="form-heading">

                    <div class="form-heading-icon">

                        <i class="far fa-edit"></i>

                    </div>


                    <div>

                        <span>
                            EDITAR EXPEDIENTE
                        </span>

                        <h3>
                            Información del paciente
                        </h3>

                        <p>
                            Modifica los datos que necesites actualizar.
                        </p>

                    </div>

                </div>



                {{-- ==========================================
                     DATOS PERSONALES
                =========================================== --}}

                <div class="form-section">


                    <div class="section-heading">

                        <div class="section-number">
                            01
                        </div>

                        <div>

                            <h4>
                                Datos personales
                            </h4>

                            <p>
                                Información básica del paciente.
                            </p>

                        </div>

                    </div>



                    <div class="row">


                        {{-- NOMBRE --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="first_name">

                                    Nombre
                                    <span>*</span>

                                </label>


                                <div class="liquid-input @error('first_name') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="far fa-user"></i>
                                    </div>


                                    <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        value="{{ old('first_name', $paciente->first_name) }}"
                                        required
                                    >

                                </div>


                                @error('first_name')

                                    <div class="field-error">
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
                                    <span>*</span>

                                </label>


                                <div class="liquid-input @error('last_name') input-error @enderror">

                                    <div class="input-icon">
                                        <i class="fas fa-signature"></i>
                                    </div>


                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        value="{{ old('last_name', $paciente->last_name) }}"
                                        required
                                    >

                                </div>


                                @error('last_name')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- NACIMIENTO --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="birth_date">
                                    Fecha de nacimiento
                                </label>


                                <div class="liquid-input">

                                    <div class="input-icon">
                                        <i class="far fa-calendar"></i>
                                    </div>


                                    <input
                                        type="date"
                                        id="birth_date"
                                        name="birth_date"
                                        value="{{ old(
                                            'birth_date',
                                            $paciente->birth_date
                                                ? $paciente->birth_date->format('Y-m-d')
                                                : ''
                                        ) }}"
                                    >

                                </div>


                                @error('birth_date')

                                    <div class="field-error">
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


                                <div class="liquid-input">

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
                                            {{ old('sex', $paciente->sex) === 'Masculino'
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            Masculino
                                        </option>


                                        <option
                                            value="Femenino"
                                            {{ old('sex', $paciente->sex) === 'Femenino'
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            Femenino
                                        </option>


                                        <option
                                            value="Otro"
                                            {{ old('sex', $paciente->sex) === 'Otro'
                                                ? 'selected'
                                                : ''
                                            }}
                                        >
                                            Otro
                                        </option>

                                    </select>

                                </div>


                                @error('sex')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- ESTADO --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label>
                                    Estado del paciente
                                </label>


                                <div class="status-control">

                                    {{-- IMPORTANTE:
                                         si está desmarcado manda 0 --}}
                                    <input
                                        type="hidden"
                                        name="active"
                                        value="0"
                                    >


                                    <label class="liquid-switch">

                                        <input
                                            type="checkbox"
                                            name="active"
                                            value="1"
                                            {{ old('active', $paciente->active)
                                                ? 'checked'
                                                : ''
                                            }}
                                        >


                                        <span class="switch-slider"></span>


                                        <span class="switch-text">

                                            <strong id="statusText">

                                                {{ old('active', $paciente->active)
                                                    ? 'Paciente activo'
                                                    : 'Paciente inactivo'
                                                }}

                                            </strong>

                                            <small>
                                                Cambiar estado
                                            </small>

                                        </span>

                                    </label>

                                </div>


                                @error('active')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>


                    </div>

                </div>



                {{-- ==========================================
                     CONTACTO
                =========================================== --}}

                <div class="form-section">


                    <div class="section-heading">

                        <div class="section-number">
                            02
                        </div>

                        <div>

                            <h4>
                                Contacto
                            </h4>

                            <p>
                                Información para comunicación.
                            </p>

                        </div>

                    </div>



                    <div class="row">


                        {{-- TELÉFONO --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="phone">
                                    Teléfono
                                </label>


                                <div class="liquid-input">

                                    <div class="input-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>


                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone', $paciente->phone) }}"
                                        placeholder="33 1234 5678"
                                    >

                                </div>


                                @error('phone')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- CORREO --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">
                                    Correo electrónico
                                </label>


                                <div class="liquid-input">

                                    <div class="input-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>


                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $paciente->email) }}"
                                        placeholder="paciente@correo.com"
                                    >

                                </div>


                                @error('email')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>



                        {{-- OCUPACIÓN --}}
                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="occupation">
                                    Ocupación
                                </label>


                                <div class="liquid-input">

                                    <div class="input-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>


                                    <input
                                        type="text"
                                        id="occupation"
                                        name="occupation"
                                        value="{{ old('occupation', $paciente->occupation) }}"
                                        placeholder="Ej. Estudiante"
                                    >

                                </div>


                                @error('occupation')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>


                    </div>

                </div>



                {{-- ==========================================
                     OBJETIVO
                =========================================== --}}

                <div class="form-section last-section">


                    <div class="section-heading">

                        <div class="section-number">
                            03
                        </div>

                        <div>

                            <h4>
                                Objetivo nutricional
                            </h4>

                            <p>
                                Meta principal del paciente.
                            </p>

                        </div>

                    </div>



                    <div class="form-group mb-0">


                        <div class="liquid-textarea">

                            <div class="textarea-icon">

                                <i class="fas fa-bullseye"></i>

                            </div>


                            <textarea
                                id="goal"
                                name="goal"
                                rows="5"
                                maxlength="1000"
                                placeholder="Describe el objetivo nutricional..."
                            >{{ old('goal', $paciente->goal) }}</textarea>


                            <div class="character-counter">

                                <span id="goalCount">
                                    {{ strlen(old('goal', $paciente->goal ?? '')) }}
                                </span>

                                / 1000

                            </div>

                        </div>


                        @error('goal')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>



                {{-- ==========================================
                     BOTONES
                =========================================== --}}

                <div class="form-actions">


                    <a
                        href="{{ route('pacientes.show', $paciente) }}"
                        class="btn-cancel"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn-save"
                    >

                        <span>

                            <i class="far fa-save"></i>

                            Guardar cambios

                        </span>


                        <div>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </button>


                </div>


            </div>



            {{-- ==================================================
                 PREVIEW
            =================================================== --}}

            <aside class="edit-side">


                <div class="preview-glass">


                    <span class="preview-eyebrow">
                        VISTA PREVIA
                    </span>


                    <div class="preview-avatar">

                        <span id="previewInitial">

                            {{ strtoupper(substr($paciente->first_name, 0, 1)) }}

                        </span>

                    </div>


                    <h3 id="previewName">

                        {{ $paciente->first_name }}
                        {{ $paciente->last_name }}

                    </h3>


                    <p id="previewOccupation">

                        {{ $paciente->occupation
                            ?? 'Sin ocupación'
                        }}

                    </p>


                    <div
                        class="preview-state {{ $paciente->active ? 'active' : 'inactive' }}"
                        id="previewState"
                    >

                        <span></span>

                        <strong id="previewStateText">

                            {{ $paciente->active
                                ? 'Paciente activo'
                                : 'Paciente inactivo'
                            }}

                        </strong>

                    </div>



                    <div class="preview-divider"></div>



                    <div class="preview-data">


                        <div>

                            <div>

                                <i class="fas fa-phone-alt"></i>

                            </div>

                            <span id="previewPhone">

                                {{ $paciente->phone
                                    ?? 'Sin teléfono'
                                }}

                            </span>

                        </div>



                        <div>

                            <div>

                                <i class="far fa-envelope"></i>

                            </div>

                            <span id="previewEmail">

                                {{ $paciente->email
                                    ?? 'Sin correo'
                                }}

                            </span>

                        </div>



                        <div>

                            <div>

                                <i class="fas fa-bullseye"></i>

                            </div>

                            <span id="previewGoal">

                                {{ $paciente->goal
                                    ?? 'Sin objetivo'
                                }}

                            </span>

                        </div>


                    </div>


                </div>



                <div class="info-glass">

                    <div>

                        <i class="fas fa-shield-alt"></i>

                    </div>


                    <p>

                        <strong>
                            Editando expediente
                        </strong>

                        Los cambios se guardarán cuando
                        presiones “Guardar cambios”.

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
            #08170f,
            #10251a 48%,
            #081810
        ) !important;

    background-attachment: fixed !important;
}


.content-wrapper,
.content-header {

    background: transparent !important;

}


.edit-patient-page {

    position: relative;

    padding-bottom: 45px;

}



/* HEADER */

.edit-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

}


.header-eyebrow {

    display: block;

    color: #8eb49a;

    font-size: 9px;

    letter-spacing: 2px;

    margin-bottom: 5px;

}


.edit-header h1 {

    margin: 0;

    color: #f4faf5;

    font-size: 30px;

    font-weight: 500;

}


.edit-header p {

    margin: 5px 0 0;

    color: rgba(216,234,220,.44);

    font-size: 11px;

}



/* BOTÓN REGRESAR */

.btn-liquid-secondary {

    height: 42px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 0 15px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.09);

    background: rgba(255,255,255,.035);

    color: rgba(228,240,230,.60) !important;

    font-size: 9px;

    text-decoration: none !important;

}



/* AMBIENTE */

.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(100px);

}


.ambient-one {

    width: 330px;

    height: 330px;

    top: 160px;

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



/* LAYOUT */

.edit-layout {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        minmax(0,1.55fr)
        minmax(270px,.55fr);

    gap: 18px;

}



/* CARD */

.edit-glass-card {

    position: relative;

    overflow: hidden;

    border-radius: 27px;

    border: 1px solid rgba(255,255,255,.11);

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.08),
            rgba(255,255,255,.018)
        );

    backdrop-filter: blur(26px);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.13),
        0 25px 55px rgba(0,0,0,.16);

}


.glass-shine {

    position: absolute;

    width: 500px;

    height: 150px;

    top: -115px;

    left: 15%;

    border-radius: 50%;

    background: rgba(255,255,255,.06);

    filter: blur(20px);

}



/* HEADING */

.form-heading {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 14px;

    padding: 26px 28px;

    border-bottom:
        1px solid rgba(255,255,255,.055);

}


.form-heading-icon {

    width: 52px;

    height: 52px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 17px;

    background:
        rgba(143,187,137,.09);

    color: #9ec198;

}


.form-heading span {

    color: rgba(183,210,188,.34);

    font-size: 7px;

    letter-spacing: 1.4px;

}


.form-heading h3 {

    margin: 3px 0;

    color: #eef7f0;

    font-size: 18px;

}


.form-heading p {

    margin: 0;

    color: rgba(208,227,212,.31);

    font-size: 8px;

}



/* SECCIONES */

.form-section {

    position: relative;

    z-index: 2;

    padding: 27px 28px 8px;

    border-bottom:
        1px solid rgba(255,255,255,.05);

}


.last-section {

    border-bottom: 0;

    padding-bottom: 27px;

}


.section-heading {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 21px;

}


.section-number {

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background:
        rgba(145,187,139,.08);

    color: #98bc93;

    font-size: 8px;

}


.section-heading h4 {

    margin: 0;

    color: rgba(239,248,241,.80);

    font-size: 12px;

}


.section-heading p {

    margin: 2px 0 0;

    color: rgba(207,226,211,.28);

    font-size: 7px;

}



/* CAMPOS */

.form-group {

    margin-bottom: 20px;

}


.form-group label {

    display: block;

    margin-bottom: 8px;

    color: rgba(224,238,226,.58);

    font-size: 9px;

}


.form-group label span {

    color: #a7ca9c;

}


.liquid-input {

    height: 52px;

    display: flex;

    align-items: center;

    border-radius: 15px;

    border:
        1px solid rgba(255,255,255,.095);

    background:
        rgba(255,255,255,.035);

    transition: .2s;

}


.liquid-input:focus-within {

    border-color:
        rgba(159,201,153,.27);

    background:
        rgba(255,255,255,.055);

    box-shadow:
        0 0 0 4px rgba(122,175,120,.045);

}


.input-icon {

    width: 45px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    color:
        rgba(158,193,161,.46);

    font-size: 11px;

}


.liquid-input input,
.liquid-input select {

    flex: 1;

    width: 100%;

    height: 100%;

    border: 0;

    outline: 0;

    padding-right: 13px;

    background: transparent;

    color: #edf7ef;

    font-family: 'Poppins', sans-serif;

    font-size: 10px;

}


.liquid-input input[type="date"] {

    color-scheme: dark;

}


.liquid-input select option {

    background: #13291c;

    color: white;

}



/* TEXTAREA */

.liquid-textarea {

    position: relative;

    min-height: 150px;

    display: flex;

    border-radius: 17px;

    border:
        1px solid rgba(255,255,255,.095);

    background:
        rgba(255,255,255,.035);

}


.textarea-icon {

    width: 45px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    padding-top: 17px;

    color:
        rgba(158,193,161,.46);

}


.liquid-textarea textarea {

    width: 100%;

    min-height: 145px;

    border: 0;

    outline: 0;

    resize: vertical;

    padding:
        16px
        45px
        25px
        0;

    background: transparent;

    color: #edf7ef;

    font-family: 'Poppins', sans-serif;

    font-size: 10px;

}


.character-counter {

    position: absolute;

    right: 13px;

    bottom: 9px;

    color:
        rgba(211,229,215,.25);

    font-size: 7px;

}



/* ESTADO SWITCH */

.status-control {

    height: 52px;

    display: flex;

    align-items: center;

    padding: 0 13px;

    border-radius: 15px;

    border:
        1px solid rgba(255,255,255,.095);

    background:
        rgba(255,255,255,.035);

}


.liquid-switch {

    width: 100%;

    display: flex !important;

    align-items: center;

    gap: 10px;

    margin: 0 !important;

    cursor: pointer;

}


.liquid-switch input {

    display: none;

}


.switch-slider {

    position: relative;

    width: 36px;

    height: 20px;

    flex-shrink: 0;

    border-radius: 20px;

    background:
        rgba(255,255,255,.09);

    transition: .2s;

}


.switch-slider::after {

    content: "";

    position: absolute;

    width: 14px;

    height: 14px;

    left: 3px;

    top: 3px;

    border-radius: 50%;

    background: rgba(230,240,232,.55);

    transition: .2s;

}


.liquid-switch input:checked
+
.switch-slider {

    background:
        rgba(115,181,119,.45);

}


.liquid-switch input:checked
+
.switch-slider::after {

    left: 19px;

    background: #afe0b3;

}


.switch-text strong {

    display: block;

    color:
        rgba(236,246,238,.72);

    font-size: 8px;

}


.switch-text small {

    color:
        rgba(206,225,210,.27);

    font-size: 6px;

}



/* ERRORES */

.input-error {

    border-color:
        rgba(213,101,101,.35) !important;

}


.field-error {

    margin-top: 5px;

    color: #d88b8b;

    font-size: 7px;

}



/* BOTONES FOOTER */

.form-actions {

    position: relative;

    z-index: 2;

    display: flex;

    justify-content: flex-end;

    gap: 9px;

    padding: 20px 28px;

    border-top:
        1px solid rgba(255,255,255,.05);

}


.btn-cancel {

    height: 45px;

    display: inline-flex;

    align-items: center;

    padding: 0 18px;

    border-radius: 14px;

    border:
        1px solid rgba(255,255,255,.08);

    color:
        rgba(221,236,224,.45) !important;

    background:
        rgba(255,255,255,.03);

    font-size: 9px;

    text-decoration: none !important;

}


.btn-save {

    position: relative;

    min-width: 180px;

    height: 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 0 47px 0 17px;

    border-radius: 14px;

    border:
        1px solid rgba(255,255,255,.20);

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

}


.btn-save > span {

    display: flex;

    align-items: center;

    gap: 7px;

}


.btn-save > div {

    position: absolute;

    right: 7px;

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background:
        rgba(17,48,24,.10);

}



/* PREVIEW */

.edit-side {

    display: flex;

    flex-direction: column;

    gap: 15px;

}


.preview-glass {

    padding: 24px 20px;

    border-radius: 25px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        linear-gradient(
            145deg,
            rgba(150,195,145,.10),
            rgba(255,255,255,.02)
        );

    backdrop-filter: blur(24px);

    text-align: center;

}


.preview-eyebrow {

    display: block;

    text-align: left;

    color:
        rgba(182,210,187,.33);

    font-size: 6px;

    letter-spacing: 1.3px;

}


.preview-avatar {

    width: 76px;

    height: 76px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 23px auto 13px;

    border-radius: 24px;

    border:
        1px solid rgba(255,255,255,.15);

    background:
        rgba(161,201,153,.13);

    color: #b4d4aa;

    font-size: 24px;

    font-weight: 600;

}


.preview-glass h3 {

    margin: 0;

    color: #eff8f1;

    font-size: 15px;

}


.preview-glass > p {

    margin: 4px 0 0;

    color:
        rgba(211,229,214,.37);

    font-size: 8px;

}


.preview-state {

    width: fit-content;

    margin: 12px auto 0;

    padding: 6px 9px;

    display: flex;

    align-items: center;

    gap: 6px;

    border-radius: 20px;

    font-size: 7px;

}


.preview-state.active {

    color: #99ce9f;

    background:
        rgba(77,157,90,.08);

}


.preview-state.inactive {

    color: #adb7af;

    background:
        rgba(255,255,255,.03);

}


.preview-state > span {

    width: 5px;

    height: 5px;

    border-radius: 50%;

    background: currentColor;

}


.preview-state strong {

    font-weight: 500;

}


.preview-divider {

    height: 1px;

    margin: 20px 0;

    background:
        rgba(255,255,255,.055);

}


.preview-data > div {

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 8px 0;

    text-align: left;

}


.preview-data > div > div {

    width: 30px;

    height: 30px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background:
        rgba(143,187,137,.07);

    color: #90b18c;

    font-size: 8px;

}


.preview-data span {

    min-width: 0;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

    color:
        rgba(215,232,218,.42);

    font-size: 8px;

}



/* INFO */

.info-glass {

    display: flex;

    gap: 10px;

    padding: 15px;

    border-radius: 18px;

    border:
        1px solid rgba(255,255,255,.07);

    background:
        rgba(255,255,255,.025);

}


.info-glass > div {

    width: 32px;

    height: 32px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background:
        rgba(140,183,135,.07);

    color: #8eac8b;

}


.info-glass p {

    margin: 0;

    color:
        rgba(205,225,209,.29);

    font-size: 7px;

}


.info-glass strong {

    display: block;

    color:
        rgba(232,242,234,.59);

    font-size: 8px;

}



/* RESPONSIVE */

@media(max-width: 1050px) {

    .edit-layout {

        grid-template-columns: 1fr;

    }

}


@media(max-width: 767px) {

    .edit-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .form-section {

        padding:
            24px
            19px
            8px;

    }


    .form-heading {

        padding:
            23px
            19px;

    }


    .form-actions {

        padding:
            18px
            19px;

    }

}


@media(max-width: 500px) {

    .form-actions {

        flex-direction: column-reverse;

    }


    .btn-cancel,
    .btn-save {

        width: 100%;

        justify-content: center;

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

    const active =
        document.querySelector('input[name="active"][type="checkbox"]');


    function updatePreview() {

        const name =
            firstName.value.trim();

        const lastname =
            lastName.value.trim();


        document.getElementById('previewName')
            .textContent =
            (name + ' ' + lastname).trim()
            || 'Paciente';


        document.getElementById('previewInitial')
            .textContent =
            name
                ? name.charAt(0).toUpperCase()
                : 'P';


        document.getElementById('previewOccupation')
            .textContent =
            occupation.value.trim()
            || 'Sin ocupación';


        document.getElementById('previewPhone')
            .textContent =
            phone.value.trim()
            || 'Sin teléfono';


        document.getElementById('previewEmail')
            .textContent =
            email.value.trim()
            || 'Sin correo';


        document.getElementById('previewGoal')
            .textContent =
            goal.value.trim()
            || 'Sin objetivo';


        document.getElementById('goalCount')
            .textContent =
            goal.value.length;



        const state =
            document.getElementById('previewState');

        const stateText =
            document.getElementById('previewStateText');

        const statusText =
            document.getElementById('statusText');


        if (active.checked) {

            state.classList.remove('inactive');

            state.classList.add('active');

            stateText.textContent =
                'Paciente activo';

            statusText.textContent =
                'Paciente activo';

        }

        else {

            state.classList.remove('active');

            state.classList.add('inactive');

            stateText.textContent =
                'Paciente inactivo';

            statusText.textContent =
                'Paciente inactivo';

        }

    }


    [
        firstName,
        lastName,
        occupation,
        phone,
        email,
        goal,
        active

    ].forEach(function (field) {

        field.addEventListener(
            'input',
            updatePreview
        );

        field.addEventListener(
            'change',
            updatePreview
        );

    });


    updatePreview();

});

</script>

@stop