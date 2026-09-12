@extends('adminlte::page')

@section('title', 'Registrar pago | NutriAdmin')


@section('content_header')

<div class="payments-header">

    <div>

        <span class="header-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN
        </span>

        <h1>
            Registrar pago
        </h1>

        <p>
            Registra un nuevo ingreso de tus pacientes.
        </p>

    </div>


    <a href="{{ route('pagos.index') }}"
       class="btn-back-glass">

        <i class="fas fa-arrow-left"></i>

        <span>
            Regresar
        </span>

    </a>

</div>

@stop



@section('content')

<div class="payment-page">

    {{-- LUCES AMBIENTALES --}}
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>


    <form method="POST"
          action="{{ route('pagos.store') }}">

        @csrf


        <div class="payment-glass-card">


            {{-- CABECERA --}}
            <div class="payment-card-header">

                <div class="payment-icon">

                    <i class="fas fa-wallet"></i>

                </div>


                <div>

                    <span class="payment-eyebrow">
                        NUEVO INGRESO
                    </span>

                    <h2>
                        Información del pago
                    </h2>

                    <p>
                        Captura los datos correspondientes al pago realizado.
                    </p>

                </div>

            </div>



            {{-- FORMULARIO --}}
            <div class="payment-form-body">

                <div class="row">


                    {{-- PACIENTE --}}
                    <div class="col-md-6">

                        <div class="nutri-form-group">

                            <label>
                                <i class="far fa-user"></i>
                                Paciente
                                <span>*</span>
                            </label>

                            <select
                                name="patient_id"
                                class="nutri-input @error('patient_id') input-error @enderror"
                                required
                            >

                                <option value="">
                                    Selecciona un paciente
                                </option>

                                @foreach($patients as $patient)

                                    <option
                                        value="{{ $patient->id }}"
                                        {{ old('patient_id') == $patient->id ? 'selected' : '' }}
                                    >

                                        {{ $patient->first_name }}
                                        {{ $patient->last_name }}

                                    </option>

                                @endforeach

                            </select>


                            @error('patient_id')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>



                    {{-- MONTO --}}
                    <div class="col-md-6">

                        <div class="nutri-form-group">

                            <label>
                                <i class="fas fa-dollar-sign"></i>
                                Monto
                                <span>*</span>
                            </label>


                            <div class="amount-wrapper">

                                <span class="amount-symbol">
                                    $
                                </span>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0.01"
                                    name="amount"
                                    value="{{ old('amount') }}"
                                    class="nutri-input amount-input @error('amount') input-error @enderror"
                                    placeholder="600.00"
                                    required
                                >

                                <span class="amount-currency">
                                    MXN
                                </span>

                            </div>


                            @error('amount')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>



                    {{-- FECHA --}}
                    <div class="col-md-6">

                        <div class="nutri-form-group">

                            <label>
                                <i class="far fa-calendar-alt"></i>
                                Fecha y hora
                                <span>*</span>
                            </label>

                            <input
                                type="datetime-local"
                                name="paid_at"
                                value="{{ old('paid_at', now()->format('Y-m-d\TH:i')) }}"
                                class="nutri-input @error('paid_at') input-error @enderror"
                                required
                            >

                            @error('paid_at')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>



                    {{-- CONCEPTO --}}
                    <div class="col-md-6">

                        <div class="nutri-form-group">

                            <label>
                                <i class="fas fa-receipt"></i>
                                Concepto
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="concept"
                                value="{{ old('concept') }}"
                                class="nutri-input @error('concept') input-error @enderror"
                                placeholder="Ej. Consulta nutricional"
                                required
                            >

                            @error('concept')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>



                    {{-- MÉTODO --}}
                    <div class="col-md-6">

                        <div class="nutri-form-group">

                            <label>
                                <i class="far fa-credit-card"></i>
                                Método de pago
                                <span>*</span>
                            </label>

                            <select
                                name="payment_method"
                                class="nutri-input @error('payment_method') input-error @enderror"
                                required
                            >

                                <option
                                    value="Efectivo"
                                    {{ old('payment_method', 'Efectivo') === 'Efectivo' ? 'selected' : '' }}
                                >
                                    Efectivo
                                </option>

                                <option
                                    value="Transferencia"
                                    {{ old('payment_method') === 'Transferencia' ? 'selected' : '' }}
                                >
                                    Transferencia
                                </option>

                                <option
                                    value="Tarjeta"
                                    {{ old('payment_method') === 'Tarjeta' ? 'selected' : '' }}
                                >
                                    Tarjeta
                                </option>

                                <option
                                    value="Otro"
                                    {{ old('payment_method') === 'Otro' ? 'selected' : '' }}
                                >
                                    Otro
                                </option>

                            </select>

                        </div>

                    </div>



                    {{-- ESTADO --}}
                    <div class="col-md-6">

                        <div class="nutri-form-group">

                            <label>
                                <i class="fas fa-circle-check"></i>
                                Estado
                                <span>*</span>
                            </label>

                            <select
                                name="status"
                                class="nutri-input @error('status') input-error @enderror"
                                required
                            >

                                <option
                                    value="Pagado"
                                    {{ old('status', 'Pagado') === 'Pagado' ? 'selected' : '' }}
                                >
                                    Pagado
                                </option>

                                <option
                                    value="Pendiente"
                                    {{ old('status') === 'Pendiente' ? 'selected' : '' }}
                                >
                                    Pendiente
                                </option>

                                <option
                                    value="Cancelado"
                                    {{ old('status') === 'Cancelado' ? 'selected' : '' }}
                                >
                                    Cancelado
                                </option>

                            </select>

                        </div>

                    </div>



                    {{-- REFERENCIA --}}
                    <div class="col-md-12">

                        <div class="nutri-form-group">

                            <label>
                                <i class="fas fa-hashtag"></i>
                                Referencia
                            </label>

                            <input
                                type="text"
                                name="reference"
                                value="{{ old('reference') }}"
                                class="nutri-input"
                                placeholder="Ej. SPEI, folio, número de operación..."
                            >

                            <small class="input-help">
                                Opcional. Útil para transferencias o pagos con tarjeta.
                            </small>

                        </div>

                    </div>



                    {{-- NOTAS --}}
                    <div class="col-md-12">

                        <div class="nutri-form-group mb-0">

                            <label>
                                <i class="far fa-note-sticky"></i>
                                Notas
                            </label>

                            <textarea
                                name="notes"
                                rows="4"
                                class="nutri-input nutri-textarea"
                                placeholder="Agrega alguna observación relacionada con el pago..."
                            >{{ old('notes') }}</textarea>

                        </div>

                    </div>


                </div>

            </div>



            {{-- FOOTER --}}
            <div class="payment-footer">


                <a href="{{ route('pagos.index') }}"
                   class="btn-cancel-glass">

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn-payment-primary"
                >

                    <i class="fas fa-check"></i>

                    Registrar pago

                </button>


            </div>

        </div>

    </form>

</div>

@stop



@section('css')

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
   FONDO GENERAL
========================================================= */

body {

    background:

        radial-gradient(
            circle at 12% 15%,
            rgba(62, 117, 82, .22),
            transparent 29%
        ),

        radial-gradient(
            circle at 92% 40%,
            rgba(108, 166, 113, .15),
            transparent 30%
        ),

        linear-gradient(
            135deg,
            #08170f 0%,
            #10251a 48%,
            #091911 100%
        ) !important;

    background-attachment: fixed !important;
}


.content-wrapper {

    background: transparent !important;

}


.content-header {

    background: transparent !important;

}



/* =========================================================
   HEADER
========================================================= */

.payments-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

    padding-top: 7px;

}


.header-eyebrow {

    display: block;

    margin-bottom: 6px;

    color: #8eb59a;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 2px;

}


.payments-header h1 {

    margin: 0;

    color: #f4faf5;

    font-size: 32px;

    font-weight: 600;

}


.payments-header p {

    margin: 6px 0 0;

    color: rgba(218, 235, 222, .52);

    font-size: 13px;

}



/* =========================================================
   BOTÓN REGRESAR
========================================================= */

.btn-back-glass {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 10px 16px;

    border-radius: 13px;

    border: 1px solid rgba(255,255,255,.12);

    background: rgba(255,255,255,.06);

    backdrop-filter: blur(16px);

    color: #b9cfbd !important;

    font-size: 12px;

    font-weight: 600;

    text-decoration: none !important;

    transition: .2s;

}


.btn-back-glass:hover {

    background: rgba(255,255,255,.11);

    color: #ffffff !important;

    transform: translateY(-1px);

}



/* =========================================================
   PÁGINA
========================================================= */

.payment-page {

    position: relative;

    min-height: 760px;

    padding-bottom: 45px;

}



/* =========================================================
   LUCES
========================================================= */

.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(100px);

}


.ambient-one {

    width: 330px;

    height: 330px;

    right: 3%;

    top: 180px;

    background: #5b9465;

    opacity: .18;

}


.ambient-two {

    width: 280px;

    height: 280px;

    left: 15%;

    bottom: 5%;

    background: #315f43;

    opacity: .22;

}



/* =========================================================
   TARJETA
========================================================= */

.payment-glass-card {

    position: relative;

    z-index: 2;

    overflow: hidden;

    max-width: 1050px;

    margin: 0 auto;

    border-radius: 28px;

    border: 1px solid rgba(255,255,255,.12);

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.09),
            rgba(255,255,255,.025)
        );

    backdrop-filter:

        blur(28px)
        saturate(140%);

    -webkit-backdrop-filter:

        blur(28px)
        saturate(140%);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.14),

        0 25px 60px rgba(0,0,0,.20);

}


.payment-glass-card::before {

    content: "";

    position: absolute;

    width: 500px;

    height: 150px;

    top: -120px;

    left: 15%;

    border-radius: 50%;

    background: rgba(255,255,255,.07);

    filter: blur(20px);

}



/* =========================================================
   CABECERA TARJETA
========================================================= */

.payment-card-header {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 20px;

    padding: 29px 33px;

    border-bottom:

        1px solid rgba(255,255,255,.07);

}


.payment-icon {

    width: 65px;

    min-width: 65px;

    height: 65px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 20px;

    border:

        1px solid rgba(255,255,255,.15);

    background:

        linear-gradient(
            145deg,
            rgba(166,207,153,.20),
            rgba(255,255,255,.04)
        );

    color: #acd09f;

    font-size: 23px;

}


.payment-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: #8fb496;

    font-size: 9px;

    letter-spacing: 1.8px;

}


.payment-card-header h2 {

    margin: 0;

    color: #f3faf4;

    font-size: 24px;

    font-weight: 600;

}


.payment-card-header p {

    margin: 6px 0 0;

    color: rgba(218,235,222,.45);

    font-size: 11px;

}



/* =========================================================
   CUERPO
========================================================= */

.payment-form-body {

    position: relative;

    z-index: 2;

    padding: 32px 33px 20px;

}



/* =========================================================
   CAMPOS
========================================================= */

.nutri-form-group {

    margin-bottom: 24px;

}


.nutri-form-group label {

    display: flex;

    align-items: center;

    gap: 7px;

    margin-bottom: 8px;

    color: rgba(229,241,231,.72);

    font-size: 11px;

    font-weight: 600;

}


.nutri-form-group label i {

    width: 14px;

    color: #8eb58d;

}


.nutri-form-group label span {

    color: #a8cfa1;

}


.nutri-input {

    width: 100%;

    height: 46px;

    padding: 0 14px;

    border-radius: 13px;

    border:

        1px solid rgba(255,255,255,.10);

    background:

        rgba(255,255,255,.055) !important;

    color: #edf6ef !important;

    font-size: 12px;

    outline: none;

    box-shadow: none !important;

    transition: .2s;

}


.nutri-input:focus {

    border-color:

        rgba(165,205,158,.45);

    background:

        rgba(255,255,255,.075) !important;

    box-shadow:

        0 0 0 3px rgba(132,181,128,.08) !important;

}


.nutri-input::placeholder {

    color:

        rgba(220,235,223,.25);

}



/* SELECT */

select.nutri-input {

    cursor: pointer;

}


select.nutri-input option {

    background: #14271c;

    color: #edf6ef;

}



/* DATE */

input[type="datetime-local"] {

    color-scheme: dark;

}



/* TEXTAREA */

.nutri-textarea {

    min-height: 115px;

    padding: 13px 14px;

    resize: vertical;

}



/* =========================================================
   MONTO
========================================================= */

.amount-wrapper {

    position: relative;

}


.amount-symbol {

    position: absolute;

    z-index: 2;

    top: 50%;

    left: 14px;

    transform: translateY(-50%);

    color: #9fc397;

    font-size: 14px;

    font-weight: 700;

}


.amount-input {

    padding-left: 31px;

    padding-right: 55px;

}


.amount-currency {

    position: absolute;

    right: 13px;

    top: 50%;

    transform: translateY(-50%);

    color:

        rgba(208,228,211,.35);

    font-size: 9px;

    font-weight: 700;

}



/* =========================================================
   AYUDA / ERRORES
========================================================= */

.input-help {

    display: block;

    margin-top: 6px;

    color:

        rgba(208,227,211,.32);

    font-size: 9px;

}


.input-error {

    border-color:

        rgba(210, 98, 98, .55) !important;

}


.error-message {

    display: block;

    margin-top: 6px;

    color: #db8c8c;

    font-size: 9px;

}



/* =========================================================
   FOOTER
========================================================= */

.payment-footer {

    position: relative;

    z-index: 2;

    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 10px;

    padding: 20px 33px;

    border-top:

        1px solid rgba(255,255,255,.07);

    background:

        rgba(0,0,0,.07);

}



/* CANCELAR */

.btn-cancel-glass {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-height: 42px;

    padding: 0 18px;

    border-radius: 13px;

    border:

        1px solid rgba(255,255,255,.10);

    background:

        rgba(255,255,255,.045);

    color:

        rgba(225,238,228,.60) !important;

    font-size: 11px;

    font-weight: 600;

    text-decoration: none !important;

    transition: .2s;

}


.btn-cancel-glass:hover {

    background:

        rgba(255,255,255,.09);

    color: white !important;

}



/* REGISTRAR */

.btn-payment-primary {

    position: relative;

    overflow: hidden;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-height: 42px;

    padding: 0 20px;

    border-radius: 13px;

    border:

        1px solid rgba(255,255,255,.22);

    background:

        linear-gradient(
            135deg,
            rgba(183,220,168,.96),
            rgba(113,166,112,.86)
        );

    color: #102417;

    font-size: 11px;

    font-weight: 700;

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.55),

        0 10px 25px rgba(72,138,88,.20);

    cursor: pointer;

    outline: none !important;

    transition: .25s;

}


.btn-payment-primary:hover {

    transform: translateY(-2px);

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.55),

        0 14px 30px rgba(72,138,88,.28);

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 767px) {

    .payments-header {

        flex-direction: column;

        align-items: flex-start;

    }


    .payments-header h1 {

        font-size: 27px;

    }


    .payment-card-header {

        align-items: flex-start;

        padding: 24px 20px;

    }


    .payment-icon {

        width: 54px;

        min-width: 54px;

        height: 54px;

        border-radius: 17px;

        font-size: 19px;

    }


    .payment-card-header h2 {

        font-size: 20px;

    }


    .payment-form-body {

        padding: 25px 20px 15px;

    }


    .payment-footer {

        padding: 18px 20px;

        flex-direction: column-reverse;

    }


    .btn-cancel-glass,
    .btn-payment-primary {

        width: 100%;

    }

}

</style>

@stop