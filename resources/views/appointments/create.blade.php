@extends('adminlte::page')

@section('title', 'Nueva cita | NutriAdmin')


@section('content_header')

<div class="appointment-page-header">

    <div>

        <span class="header-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN · AGENDA
        </span>

        <h1>Nueva cita</h1>

        <p>
            Programa una consulta con uno de tus pacientes.
        </p>

    </div>


    <a
        href="{{ route('citas.index') }}"
        class="btn-liquid-secondary"
    >

        <i class="fas fa-arrow-left"></i>

        Regresar

    </a>

</div>

@stop



@section('content')

<div class="appointment-create-page">


    {{-- LUCES AMBIENTALES --}}
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>
    <div class="ambient ambient-three"></div>



    <form
        method="POST"
        action="{{ route('citas.store') }}"
        id="appointmentForm"
    >

        @csrf


        <div class="appointment-layout">


            {{-- =====================================================
                 FORMULARIO PRINCIPAL
            ====================================================== --}}

            <div class="appointment-form-glass">


                <div class="glass-shine"></div>


                {{-- HEADER --}}
                <div class="form-main-header">


                    <div class="heading-main">


                        <div class="heading-icon">

                            <i class="far fa-calendar-plus"></i>

                        </div>


                        <div>

                            <span>
                                PROGRAMAR CONSULTA
                            </span>

                            <h3>
                                Información de la cita
                            </h3>

                            <p>
                                Selecciona paciente, fecha y detalles de la consulta.
                            </p>

                        </div>

                    </div>


                    <div class="required-badge">

                        <span>*</span>

                        Campos obligatorios

                    </div>


                </div>



                {{-- =====================================================
                     01 PACIENTE Y HORARIO
                ====================================================== --}}

                <div class="form-section">


                    <div class="section-heading">

                        <span class="section-number">
                            01
                        </span>

                        <div>

                            <h4>
                                Paciente y horario
                            </h4>

                            <p>
                                Define quién será atendido y cuándo.
                            </p>

                        </div>

                    </div>



                    <div class="row">


                        {{-- PACIENTE --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="patient_id">

                                    Paciente

                                    <span class="required">*</span>

                                </label>


                                <div class="liquid-input liquid-select @error('patient_id') input-error @enderror">


                                    <div class="input-icon">

                                        <i class="far fa-user"></i>

                                    </div>


                                    <select
                                        id="patient_id"
                                        name="patient_id"
                                        required
                                    >

                                        <option value="">
                                            Selecciona un paciente
                                        </option>


                                        @foreach($patients as $patient)

                                            <option
                                                value="{{ $patient->id }}"
                                                data-name="{{ $patient->first_name }} {{ $patient->last_name }}"
                                                data-email="{{ $patient->email ?? '' }}"
                                                data-phone="{{ $patient->phone ?? '' }}"
                                                {{ old('patient_id') == $patient->id ? 'selected' : '' }}
                                            >

                                                {{ $patient->first_name }}
                                                {{ $patient->last_name }}

                                            </option>

                                        @endforeach

                                    </select>


                                </div>


                                @error('patient_id')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        </div>



                        {{-- FECHA Y HORA --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="appointment_at">

                                    Fecha y hora

                                    <span class="required">*</span>

                                </label>


                                <div class="liquid-input @error('appointment_at') input-error @enderror">


                                    <div class="input-icon">

                                        <i class="far fa-clock"></i>

                                    </div>


                                    <input
                                        type="datetime-local"
                                        id="appointment_at"
                                        name="appointment_at"
                                        value="{{ old('appointment_at') }}"
                                        required
                                    >


                                </div>


                                @error('appointment_at')

                                    <div class="field-error">

                                        <i class="fas fa-exclamation-circle"></i>

                                        {{ $message }}

                                    </div>

                                @enderror


                            </div>

                        </div>


                    </div>

                </div>



                {{-- =====================================================
                     02 DETALLES
                ====================================================== --}}

                <div class="form-section">


                    <div class="section-heading">

                        <span class="section-number">
                            02
                        </span>

                        <div>

                            <h4>
                                Detalles de la consulta
                            </h4>

                            <p>
                                Indica el motivo y estado inicial.
                            </p>

                        </div>

                    </div>



                    <div class="row">


                        {{-- MOTIVO --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="reason">
                                    Motivo
                                </label>


                                <div class="liquid-input @error('reason') input-error @enderror">


                                    <div class="input-icon">

                                        <i class="fas fa-stethoscope"></i>

                                    </div>


                                    <input
                                        type="text"
                                        id="reason"
                                        name="reason"
                                        value="{{ old('reason') }}"
                                        placeholder="Ej. Consulta de seguimiento"
                                    >


                                </div>


                                @error('reason')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror


                            </div>

                        </div>



                        {{-- ESTADO --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="status">
                                    Estado
                                </label>


                                <div class="liquid-input liquid-select">


                                    <div class="input-icon">

                                        <i class="fas fa-circle-notch"></i>

                                    </div>


                                    <select
                                        id="status"
                                        name="status"
                                        required
                                    >

                                        <option
                                            value="Pendiente"
                                            {{ old('status', 'Pendiente') === 'Pendiente' ? 'selected' : '' }}
                                        >
                                            Pendiente
                                        </option>


                                        <option
                                            value="Confirmada"
                                            {{ old('status') === 'Confirmada' ? 'selected' : '' }}
                                        >
                                            Confirmada
                                        </option>


                                        <option
                                            value="Completada"
                                            {{ old('status') === 'Completada' ? 'selected' : '' }}
                                        >
                                            Completada
                                        </option>


                                        <option
                                            value="Cancelada"
                                            {{ old('status') === 'Cancelada' ? 'selected' : '' }}
                                        >
                                            Cancelada
                                        </option>

                                    </select>


                                </div>

                            </div>

                        </div>


                    </div>

                </div>



                {{-- =====================================================
                     03 NOTAS
                ====================================================== --}}

                <div class="form-section last-section">


                    <div class="section-heading">

                        <span class="section-number">
                            03
                        </span>

                        <div>

                            <h4>
                                Notas adicionales
                            </h4>

                            <p>
                                Información que pueda ser útil para la consulta.
                            </p>

                        </div>

                    </div>



                    <div class="form-group mb-0">


                        <div class="liquid-textarea @error('notes') input-error @enderror">


                            <div class="textarea-icon">

                                <i class="far fa-clipboard"></i>

                            </div>


                            <textarea
                                id="notes"
                                name="notes"
                                rows="5"
                                maxlength="1000"
                                placeholder="Información adicional de la cita..."
                            >{{ old('notes') }}</textarea>


                            <div class="character-counter">

                                <span id="notesCount">
                                    {{ strlen(old('notes', '')) }}
                                </span>

                                / 1000

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
                     ACCIONES
                ====================================================== --}}

                <div class="form-actions">


                    <a
                        href="{{ route('citas.index') }}"
                        class="btn-cancel-liquid"
                    >

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn-save-liquid"
                    >

                        <span>

                            <i class="far fa-calendar-check"></i>

                            Guardar cita

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

            <aside class="appointment-sidebar">


                {{-- PREVIEW --}}
                <div class="appointment-preview-glass">


                    <div class="preview-shine"></div>


                    <div class="preview-header">


                        <div>

                            <span>
                                VISTA PREVIA
                            </span>

                            <h4>
                                Nueva cita
                            </h4>

                        </div>


                        <div
                            class="preview-status pending"
                            id="previewStatus"
                        >

                            <span></span>

                            <strong id="previewStatusText">
                                Pendiente
                            </strong>

                        </div>


                    </div>



                    {{-- CALENDARIO --}}
                    <div class="preview-date">


                        <div class="date-box">

                            <span id="previewDay">
                                —
                            </span>

                            <small id="previewMonth">
                                MES
                            </small>

                        </div>


                        <div class="date-info">

                            <span>
                                FECHA Y HORA
                            </span>

                            <h3 id="previewDateText">
                                Sin fecha seleccionada
                            </h3>

                            <p id="previewTime">
                                Selecciona el horario
                            </p>

                        </div>


                    </div>



                    <div class="preview-divider"></div>



                    {{-- PACIENTE --}}
                    <div class="preview-patient">


                        <div
                            class="preview-avatar"
                            id="previewAvatar"
                        >

                            ?

                        </div>


                        <div>

                            <span>
                                PACIENTE
                            </span>

                            <h4 id="previewPatient">
                                Sin seleccionar
                            </h4>

                            <p id="previewContact">
                                Selecciona un paciente
                            </p>

                        </div>


                    </div>



                    {{-- MOTIVO --}}
                    <div class="preview-reason">


                        <div>

                            <i class="fas fa-stethoscope"></i>

                        </div>


                        <div>

                            <span>
                                MOTIVO
                            </span>

                            <strong id="previewReason">
                                Sin motivo registrado
                            </strong>

                        </div>


                    </div>



                    {{-- NOTA --}}
                    <div class="preview-note">


                        <span>
                            NOTAS
                        </span>

                        <p id="previewNotes">
                            Sin notas adicionales.
                        </p>


                    </div>


                </div>



                {{-- CONSEJO --}}
                <div class="agenda-tip-glass">


                    <div class="tip-icon">

                        <i class="fas fa-seedling"></i>

                    </div>


                    <div>

                        <span>
                            NUTRIADMIN TIP
                        </span>

                        <h4>
                            Agenda organizada
                        </h4>

                        <p>
                            Mantener las citas actualizadas facilita
                            el seguimiento de tus pacientes.
                        </p>

                    </div>


                </div>



                {{-- INDICADORES --}}
                <div class="appointment-info-glass">


                    <div>

                        <i class="far fa-calendar-check"></i>

                        <span>
                            La cita aparecerá automáticamente
                            en tu calendario.
                        </span>

                    </div>


                    <div>

                        <i class="fas fa-user-check"></i>

                        <span>
                            Quedará vinculada al expediente
                            del paciente seleccionado.
                        </span>

                    </div>


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


.appointment-create-page {

    position: relative;

    min-height: 800px;

    padding-bottom: 45px;

}



/* =========================================================
   HEADER
========================================================= */

.appointment-page-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

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


.appointment-page-header h1 {

    margin: 0;

    color: #f4faf5;

    font-size: 30px;

    font-weight: 500;

    letter-spacing: -.6px;

}


.appointment-page-header p {

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

    border: 1px solid rgba(255,255,255,.09);

    background: rgba(255,255,255,.035);

    backdrop-filter: blur(18px);

    color: rgba(228,240,230,.60) !important;

    font-size: 9px;

    text-decoration: none !important;

    transition: .2s;

}


.btn-liquid-secondary:hover {

    transform: translateY(-2px);

    color: #edf7ef !important;

    background: rgba(255,255,255,.065);

}



/* =========================================================
   AMBIENTE
========================================================= */

.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(100px);

}


.ambient-one {

    width: 340px;

    height: 340px;

    right: 2%;

    top: 150px;

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

    width: 180px;

    height: 180px;

    top: 570px;

    left: 3%;

    background: rgba(139,182,121,.07);

}



/* =========================================================
   LAYOUT
========================================================= */

.appointment-layout {

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

.appointment-form-glass {

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

    left: 15%;

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

    justify-content: space-between;

    align-items: center;

    gap: 20px;

    padding: 27px 28px;

    border-bottom:
        1px solid rgba(255,255,255,.055);

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

    justify-content: center;

    align-items: center;

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


.required-badge {

    padding: 7px 10px;

    border-radius: 11px;

    border: 1px solid rgba(255,255,255,.07);

    background: rgba(255,255,255,.025);

    color: rgba(210,229,214,.31);

    font-size: 7px;

}


.required-badge span,
.required {

    color: #a7ca9d;

}



/* =========================================================
   SECCIONES
========================================================= */

.form-section {

    position: relative;

    z-index: 2;

    padding: 27px 28px 8px;

    border-bottom:
        1px solid rgba(255,255,255,.05);

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

    justify-content: center;

    align-items: center;

    border-radius: 10px;

    background: rgba(145,187,139,.08);

    color: #99bd93;

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


.form-group label {

    display: block;

    margin-bottom: 8px;

    color: rgba(224,238,226,.58);

    font-size: 9px;

    font-weight: 400;

}



/* =========================================================
   INPUT
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
        0 0 0 4px rgba(122,175,120,.045);

}


.input-icon {

    width: 45px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    align-items: center;

    color: rgba(158,193,161,.46);

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

    color: rgba(204,224,208,.22);

}


.liquid-input input[type="datetime-local"] {

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

    min-height: 150px;

    display: flex;

    align-items: flex-start;

    border-radius: 17px;

    border:
        1px solid rgba(255,255,255,.095);

    background:
        rgba(255,255,255,.035);

    transition: .22s;

}


.liquid-textarea:focus-within {

    border-color:
        rgba(159,201,153,.27);

    background:
        rgba(255,255,255,.055);

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

    padding:
        16px
        50px
        28px
        0;

    border: none;

    outline: none;

    resize: vertical;

    background: transparent;

    color: #edf7ef;

    font-family: 'Poppins', sans-serif;

    font-size: 10px;

    line-height: 1.6;

}


.liquid-textarea textarea::placeholder {

    color: rgba(204,224,208,.22);

}


.character-counter {

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

    border-color:
        rgba(213,101,101,.34) !important;

}


.field-error {

    display: flex;

    align-items: center;

    gap: 5px;

    margin-top: 6px;

    color: #d88a8a;

    font-size: 7px;

}



/* =========================================================
   ACCIONES
========================================================= */

.form-actions {

    position: relative;

    z-index: 2;

    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 9px;

    padding: 20px 28px;

    border-top:
        1px solid rgba(255,255,255,.05);

    background:
        rgba(255,255,255,.012);

}


.btn-cancel-liquid {

    height: 45px;

    display: inline-flex;

    justify-content: center;

    align-items: center;

    padding: 0 18px;

    border-radius: 14px;

    border:
        1px solid rgba(255,255,255,.08);

    background:
        rgba(255,255,255,.03);

    color:
        rgba(221,236,224,.45) !important;

    font-size: 9px;

    text-decoration: none !important;

}


.btn-save-liquid {

    position: relative;

    min-width: 175px;

    height: 45px;

    display: flex;

    justify-content: center;

    align-items: center;

    padding:
        0
        46px
        0
        17px;

    border-radius: 14px;

    border:
        1px solid rgba(255,255,255,.21);

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
        inset 0 1px 1px rgba(255,255,255,.52),
        0 12px 28px rgba(70,135,84,.18);

    transition: .22s;

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

    justify-content: center;

    align-items: center;

    border-radius: 10px;

    background:
        rgba(17,48,24,.10);

}


.btn-save-liquid:hover {

    transform: translateY(-2px);

}



/* =========================================================
   SIDEBAR
========================================================= */

.appointment-sidebar {

    display: flex;

    flex-direction: column;

    gap: 15px;

}



/* =========================================================
   PREVIEW
========================================================= */

.appointment-preview-glass {

    position: relative;

    overflow: hidden;

    padding: 22px;

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

    -webkit-backdrop-filter: blur(24px);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.12),
        0 18px 40px rgba(0,0,0,.12);

}


.preview-shine {

    position: absolute;

    width: 230px;

    height: 90px;

    top: -65px;

    left: 25px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.055);

    filter: blur(15px);

}



/* HEADER PREVIEW */

.preview-header {

    position: relative;

    z-index: 2;

    display: flex;

    justify-content: space-between;

    align-items: center;

}


.preview-header > div:first-child span {

    color:
        rgba(182,210,187,.33);

    font-size: 6px;

    letter-spacing: 1.3px;

}


.preview-header h4 {

    margin: 3px 0 0;

    color: #edf7ef;

    font-size: 12px;

}



/* ESTADO */

.preview-status {

    display: flex;

    align-items: center;

    gap: 5px;

    padding: 6px 8px;

    border-radius: 20px;

    font-size: 6px;

}


.preview-status > span {

    width: 5px;

    height: 5px;

    border-radius: 50%;

    background: currentColor;

    box-shadow: 0 0 7px currentColor;

}


.preview-status strong {

    font-weight: 500;

}


.preview-status.pending {

    color: #dbc476;

    background:
        rgba(194,160,66,.08);

}


.preview-status.confirmed {

    color: #96d09f;

    background:
        rgba(81,160,94,.08);

}


.preview-status.completed {

    color: #8dc2c7;

    background:
        rgba(77,154,163,.08);

}


.preview-status.cancelled {

    color: #d78686;

    background:
        rgba(185,74,74,.08);

}



/* =========================================================
   FECHA PREVIEW
========================================================= */

.preview-date {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 13px;

    margin-top: 22px;

}


.date-box {

    width: 65px;

    height: 69px;

    flex-shrink: 0;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    border-radius: 19px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(143,187,137,.09);

}


.date-box span {

    color: #b2d1a9;

    font-size: 22px;

    font-weight: 500;

    line-height: 22px;

}


.date-box small {

    margin-top: 4px;

    color:
        rgba(197,218,201,.34);

    font-size: 6px;

    letter-spacing: 1px;

}


.date-info > span {

    display: block;

    color:
        rgba(183,210,188,.30);

    font-size: 6px;

    letter-spacing: 1px;

}


.date-info h3 {

    margin: 4px 0 3px;

    color: #edf7ef;

    font-size: 11px;

    font-weight: 500;

}


.date-info p {

    margin: 0;

    color:
        rgba(207,227,211,.32);

    font-size: 7px;

}



/* =========================================================
   DIVIDER
========================================================= */

.preview-divider {

    position: relative;

    z-index: 2;

    height: 1px;

    margin: 20px 0;

    background:
        rgba(255,255,255,.055);

}



/* =========================================================
   PACIENTE PREVIEW
========================================================= */

.preview-patient {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 11px;

}


.preview-avatar {

    width: 46px;

    height: 46px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    align-items: center;

    border-radius: 15px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(144,188,138,.09);

    color: #add0a4;

    font-size: 13px;

    font-weight: 600;

}


.preview-patient span {

    color:
        rgba(183,210,188,.29);

    font-size: 6px;

    letter-spacing: 1px;

}


.preview-patient h4 {

    margin: 2px 0;

    color:
        rgba(239,247,240,.77);

    font-size: 10px;

}


.preview-patient p {

    margin: 0;

    color:
        rgba(207,227,211,.30);

    font-size: 7px;

}



/* =========================================================
   MOTIVO
========================================================= */

.preview-reason {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 10px;

    margin-top: 18px;

    padding: 11px;

    border-radius: 14px;

    border:
        1px solid rgba(255,255,255,.05);

    background:
        rgba(255,255,255,.023);

}


.preview-reason > div:first-child {

    width: 32px;

    height: 32px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    align-items: center;

    border-radius: 10px;

    background:
        rgba(143,187,137,.07);

    color: #91b38e;

    font-size: 8px;

}


.preview-reason span {

    display: block;

    color:
        rgba(183,210,188,.27);

    font-size: 6px;

}


.preview-reason strong {

    display: block;

    margin-top: 2px;

    color:
        rgba(235,245,237,.61);

    font-size: 8px;

    font-weight: 500;

}



/* =========================================================
   NOTAS PREVIEW
========================================================= */

.preview-note {

    position: relative;

    z-index: 2;

    margin-top: 12px;

    padding: 12px;

    border-radius: 14px;

    background:
        rgba(255,255,255,.022);

}


.preview-note span {

    display: block;

    margin-bottom: 4px;

    color:
        rgba(183,210,188,.27);

    font-size: 6px;

    letter-spacing: 1px;

}


.preview-note p {

    display: -webkit-box;

    overflow: hidden;

    margin: 0;

    color:
        rgba(211,229,214,.36);

    font-size: 7px;

    line-height: 1.6;

    -webkit-box-orient: vertical;

    -webkit-line-clamp: 3;

}



/* =========================================================
   TIP
========================================================= */

.agenda-tip-glass {

    display: flex;

    gap: 10px;

    padding: 17px;

    border-radius: 20px;

    border:
        1px solid rgba(255,255,255,.08);

    background:
        rgba(255,255,255,.03);

    backdrop-filter: blur(20px);

}


.tip-icon {

    width: 38px;

    height: 38px;

    flex-shrink: 0;

    display: flex;

    justify-content: center;

    align-items: center;

    border-radius: 12px;

    background:
        rgba(143,187,137,.08);

    color: #96b992;

}


.agenda-tip-glass span {

    display: block;

    color:
        rgba(181,209,186,.30);

    font-size: 6px;

    letter-spacing: 1px;

}


.agenda-tip-glass h4 {

    margin: 2px 0 4px;

    color: #eaf5ec;

    font-size: 10px;

}


.agenda-tip-glass p {

    margin: 0;

    color:
        rgba(207,225,211,.29);

    font-size: 7px;

    line-height: 1.55;

}



/* =========================================================
   INFO
========================================================= */

.appointment-info-glass {

    padding: 15px;

    border-radius: 18px;

    border:
        1px solid rgba(255,255,255,.07);

    background:
        rgba(255,255,255,.022);

}


.appointment-info-glass > div {

    display: flex;

    align-items: flex-start;

    gap: 8px;

    padding: 7px 0;

}


.appointment-info-glass i {

    margin-top: 1px;

    color: #8fac8c;

    font-size: 8px;

}


.appointment-info-glass span {

    color:
        rgba(205,225,209,.28);

    font-size: 7px;

    line-height: 1.5;

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 1050px) {

    .appointment-layout {

        grid-template-columns: 1fr;

    }


    .appointment-sidebar {

        display: grid;

        grid-template-columns:
            1fr
            1fr;

    }


    .appointment-preview-glass {

        grid-row: span 2;

    }

}


@media(max-width: 767px) {

    .appointment-page-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .form-main-header {

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


    .form-main-header {

        padding:
            23px
            19px;

    }


    .form-actions {

        padding:
            18px
            19px;

    }


    .appointment-sidebar {

        display: flex;

    }

}


@media(max-width: 500px) {

    .form-actions {

        flex-direction: column-reverse;

        align-items: stretch;

    }


    .btn-cancel-liquid,
    .btn-save-liquid {

        width: 100%;

    }

}

</style>

@stop



@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {


    const patientSelect =
        document.getElementById('patient_id');

    const appointmentAt =
        document.getElementById('appointment_at');

    const reason =
        document.getElementById('reason');

    const status =
        document.getElementById('status');

    const notes =
        document.getElementById('notes');



    /* =====================================================
       MESES
    ===================================================== */

    const months = [

        'ENE',
        'FEB',
        'MAR',
        'ABR',
        'MAY',
        'JUN',
        'JUL',
        'AGO',
        'SEP',
        'OCT',
        'NOV',
        'DIC'

    ];


    const fullMonths = [

        'enero',
        'febrero',
        'marzo',
        'abril',
        'mayo',
        'junio',
        'julio',
        'agosto',
        'septiembre',
        'octubre',
        'noviembre',
        'diciembre'

    ];



    /* =====================================================
       ACTUALIZAR PACIENTE
    ===================================================== */

    function updatePatient() {


        const option =
            patientSelect.options[
                patientSelect.selectedIndex
            ];


        const name =
            option.dataset.name || '';


        const email =
            option.dataset.email || '';


        const phone =
            option.dataset.phone || '';


        document
            .getElementById('previewPatient')
            .textContent =
            name || 'Sin seleccionar';


        document
            .getElementById('previewAvatar')
            .textContent =
            name
                ? name.charAt(0).toUpperCase()
                : '?';



        let contact =
            email || phone;


        if (email && phone) {

            contact =
                phone + ' · ' + email;

        }


        document
            .getElementById('previewContact')
            .textContent =
            contact || 'Sin información de contacto';

    }



    /* =====================================================
       ACTUALIZAR FECHA
    ===================================================== */

    function updateDate() {


        if (!appointmentAt.value) {


            document
                .getElementById('previewDay')
                .textContent = '—';


            document
                .getElementById('previewMonth')
                .textContent = 'MES';


            document
                .getElementById('previewDateText')
                .textContent =
                'Sin fecha seleccionada';


            document
                .getElementById('previewTime')
                .textContent =
                'Selecciona el horario';


            return;

        }



        const date =
            new Date(appointmentAt.value);


        if (isNaN(date.getTime())) {
            return;
        }


        document
            .getElementById('previewDay')
            .textContent =
            String(date.getDate())
                .padStart(2, '0');


        document
            .getElementById('previewMonth')
            .textContent =
            months[date.getMonth()];


        document
            .getElementById('previewDateText')
            .textContent =
            date.getDate()
            + ' de '
            + fullMonths[date.getMonth()]
            + ' de '
            + date.getFullYear();


        const hours =
            String(date.getHours())
                .padStart(2, '0');


        const minutes =
            String(date.getMinutes())
                .padStart(2, '0');


        document
            .getElementById('previewTime')
            .textContent =
            hours + ':' + minutes + ' hrs';

    }



    /* =====================================================
       MOTIVO
    ===================================================== */

    function updateReason() {


        document
            .getElementById('previewReason')
            .textContent =
            reason.value.trim()
            || 'Sin motivo registrado';

    }



    /* =====================================================
       NOTAS
    ===================================================== */

    function updateNotes() {


        document
            .getElementById('previewNotes')
            .textContent =
            notes.value.trim()
            || 'Sin notas adicionales.';


        document
            .getElementById('notesCount')
            .textContent =
            notes.value.length;

    }



    /* =====================================================
       ESTADO
    ===================================================== */

    function updateStatus() {


        const preview =
            document.getElementById('previewStatus');


        const previewText =
            document.getElementById('previewStatusText');


        const currentStatus =
            status.value;


        preview.classList.remove(
            'pending',
            'confirmed',
            'completed',
            'cancelled'
        );


        switch (currentStatus) {

            case 'Confirmada':

                preview.classList.add('confirmed');

                break;


            case 'Completada':

                preview.classList.add('completed');

                break;


            case 'Cancelada':

                preview.classList.add('cancelled');

                break;


            default:

                preview.classList.add('pending');

                break;

        }


        previewText.textContent =
            currentStatus;

    }



    /* =====================================================
       EVENTOS
    ===================================================== */

    patientSelect.addEventListener(
        'change',
        updatePatient
    );


    appointmentAt.addEventListener(
        'input',
        updateDate
    );


    reason.addEventListener(
        'input',
        updateReason
    );


    status.addEventListener(
        'change',
        updateStatus
    );


    notes.addEventListener(
        'input',
        updateNotes
    );



    /* =====================================================
       INICIALIZAR
    ===================================================== */

    updatePatient();

    updateDate();

    updateReason();

    updateStatus();

    updateNotes();

});

</script>

@stop