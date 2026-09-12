@extends('adminlte::page')

@section('title', 'Citas | NutriAdmin')


@section('content_header')

<div class="appointments-header">

    <div>

        <span class="header-eyebrow">

            <i class="fas fa-leaf mr-1"></i>

            NUTRIADMIN

        </span>

        <h1>Calendario</h1>

        <p>

            Organiza y consulta las citas de tus pacientes.

        </p>

    </div>


    <a href="{{ route('citas.create') }}"

       class="btn-liquid-primary">

        <i class="fas fa-plus"></i>

        <span>Nueva cita</span>

    </a>

</div>

@stop


@section('content')

@php

    $calendarAppointments = $appointments->map(function ($appointment) {

    return [

        'id' => $appointment->id,

        'date' => $appointment->appointment_at

            ->format('Y-m-d H:i:s'),

        'patient' => trim(

            ($appointment->patient->first_name ?? '') . ' ' .

            ($appointment->patient->last_name ?? '')

        ),

        'reason' => $appointment->reason

            ?? 'Consulta nutricional',

        'status' => $appointment->status

            ?? 'Pendiente',

        'edit_url' => route(

            'citas.edit',

            $appointment

        ),

        'cancel_url' => route(

            'citas.cancel',

            $appointment

        ),

        'delete_url' => route(

            'citas.destroy',

            $appointment

        ),

    ];

})->values();


    $upcomingAppointments = $appointments

        ->filter(function ($appointment) {

            return $appointment->appointment_at >= now()->startOfDay();

        })

        ->sortBy('appointment_at')

        ->take(5);

@endphp


<div class="nutri-calendar-page">


    <div class="ambient ambient-one"></div>

    <div class="ambient ambient-two"></div>

    <div class="ambient ambient-three"></div>


    @if(session('success'))

        <div class="glass-alert">

            <div class="glass-alert-icon">

                <i class="fas fa-check"></i>

            </div>

            <div>

                <strong>¡Listo!</strong>

                <span>

                    {{ session('success') }}

                </span>

            </div>

        </div>

    @endif


    <div class="calendar-hero">

        <div class="hero-content">

            <div class="hero-icon">

                <i class="far fa-calendar-alt"></i>

            </div>


            <div>

                <span class="hero-small">

                    Agenda nutricional

                </span>

                <h2>

                    Organiza tu

                    <span>día.</span>

                </h2>

                <p>

                    Mantén tus consultas organizadas y consulta

                    rápidamente qué pacientes tienes programados.

                </p>

            </div>

        </div>


        <div class="hero-decoration">

            <div class="floating-glass glass-leaf">

                <i class="fas fa-leaf"></i>

            </div>

            <div class="floating-glass glass-clock">

                <i class="far fa-clock"></i>

            </div>

            <div class="big-calendar-icon">

                <i class="far fa-calendar-check"></i>

            </div>

        </div>

    </div>


    <div class="calendar-stats">

        <div class="liquid-stat">

            <div class="stat-icon">

                <i class="far fa-calendar"></i>

            </div>

            <div>

                <span>Total citas</span>

                <h3>

                    {{ $appointments->count() }}

                </h3>

            </div>

        </div>


        <div class="liquid-stat">

            <div class="stat-icon pending-icon">

                <i class="far fa-clock"></i>

            </div>

            <div>

                <span>Pendientes</span>

                <h3>

                    {{ $appointments->where('status', 'Pendiente')->count() }}

                </h3>

            </div>

        </div>


        <div class="liquid-stat">

            <div class="stat-icon confirmed-icon">

                <i class="fas fa-check"></i>

            </div>

            <div>

                <span>Confirmadas</span>

                <h3>

                    {{ $appointments->where('status', 'Confirmada')->count() }}

                </h3>

            </div>

        </div>


        <div class="liquid-stat">

            <div class="stat-icon completed-icon">

                <i class="fas fa-check-double"></i>

            </div>

            <div>

                <span>Completadas</span>

                <h3>

                    {{ $appointments->where('status', 'Completada')->count() }}

                </h3>

            </div>

        </div>

    </div>


    <div class="calendar-layout">


        <div class="calendar-glass-card">


            <div class="calendar-card-header">

                <div>

                    <span class="calendar-eyebrow">

                        CALENDARIO MENSUAL

                    </span>

                    <h3 id="calendarTitle">

                        Calendario

                    </h3>

                </div>


                <div class="calendar-controls">

                    <button

                        type="button"

                        class="calendar-control"

                        id="prevMonth"

                    >

                        <i class="fas fa-chevron-left"></i>

                    </button>


                    <button

                        type="button"

                        class="today-button"

                        id="todayButton"

                    >

                        Hoy

                    </button>


                    <button

                        type="button"

                        class="calendar-control"

                        id="nextMonth"

                    >

                        <i class="fas fa-chevron-right"></i>

                    </button>

                </div>

            </div>


            <div class="calendar-week">

                <div>LUN</div>

                <div>MAR</div>

                <div>MIÉ</div>

                <div>JUE</div>

                <div>VIE</div>

                <div>SÁB</div>

                <div>DOM</div>

            </div>


            <div

                class="calendar-grid"

                id="calendarGrid"

            >

            </div>


            <div class="calendar-legend">

                <div>

                    <span class="legend-dot appointment-color"></span>

                    Con cita

                </div>


                <div>

                    <span class="legend-dot today-color"></span>

                    Hoy

                </div>


                <div>

                    <span class="legend-dot multiple-color"></span>

                    Varias citas

                </div>

            </div>

        </div>


        <div class="side-panel">


            <div class="today-glass">

                <span class="today-label">

                    HOY

                </span>

                <div class="today-date">

                    <div

                        class="today-number"

                        id="todayNumber"

                    >

                    </div>

                    <div>

                        <h4 id="todayDay"></h4>

                        <p id="todayMonth"></p>

                    </div>

                </div>


                <div class="today-message">

                    <i class="fas fa-seedling"></i>

                    <span>

                        Un buen seguimiento comienza

                        con una agenda organizada.

                    </span>

                </div>

            </div>


            <div class="upcoming-glass">

                <div class="upcoming-title">

                    <div>

                        <span>

                            AGENDA

                        </span>

                        <h4>

                            Próximas citas

                        </h4>

                    </div>


                    <div class="mini-calendar-icon">

                        <i class="far fa-calendar"></i>

                    </div>

                </div>


                @if($upcomingAppointments->isEmpty())

                    <div class="empty-upcoming">

                        <div>

                            <i class="far fa-calendar-check"></i>

                        </div>

                        <h5>

                            Agenda libre

                        </h5>

                        <p>

                            No tienes próximas citas programadas.

                        </p>

                    </div>


                @else


                    <div class="upcoming-list">


                        @foreach($upcomingAppointments as $appointment)

                            <div class="upcoming-item">


                                <div class="appointment-time">

                                    <span>

                                        {{ $appointment->appointment_at->format('H:i') }}

                                    </span>

                                    <small>

                                        {{ $appointment->appointment_at->format('d/m') }}

                                    </small>

                                </div>


                                <div class="upcoming-info">

                                    <h5>

                                        {{ $appointment->patient->first_name }}

                                        {{ $appointment->patient->last_name }}

                                    </h5>


                                    <p>

                                        {{ $appointment->reason ?? 'Consulta nutricional' }}

                                    </p>


                                    @if($appointment->status === 'Confirmada')

                                        <span class="mini-status confirmed">

                                            Confirmada

                                        </span>

                                    @elseif($appointment->status === 'Cancelada')

                                        <span class="mini-status cancelled">

                                            Cancelada

                                        </span>

                                    @elseif($appointment->status === 'Completada')

                                        <span class="mini-status completed">

                                            Completada

                                        </span>

                                    @else

                                        <span class="mini-status pending">

                                            Pendiente

                                        </span>

                                    @endif

                                </div>


                            </div>

                        @endforeach


                    </div>


                @endif


                <a

                    href="{{ route('citas.create') }}"

                    class="new-appointment-glass"

                >

                    <i class="fas fa-plus"></i>

                    Programar cita

                </a>

            </div>

        </div>

    </div>


    <div

        class="selected-day-panel"

        id="selectedDayPanel"

    >

        <div class="selected-header">

            <div>

                <span>

                    DETALLE DEL DÍA

                </span>

                <h4 id="selectedDayTitle">

                    Selecciona un día

                </h4>

            </div>


            <div class="selected-icon">

                <i class="far fa-calendar-check"></i>

            </div>

        </div>


        <div

            class="selected-appointments"

            id="selectedAppointments"

        >

            <div class="select-day-message">

                <i class="far fa-hand-pointer"></i>

                <p>

                    Selecciona una fecha del calendario

                    para consultar sus citas.

                </p>

            </div>

        </div>

    </div>


</div>

@stop


@section('css')

<link

    rel="stylesheet"

    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"

\>

<link

    rel="stylesheet"

    href="{{ asset('css/nutriadmin.css') }}"

\>


<style>


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


.appointments-header {

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


.appointments-header h1 {

    margin: 0;

    color: #f4faf5;

    font-size: 32px;

    font-weight: 600;

}


.appointments-header p {

    margin: 6px 0 0;

    color: rgba(218, 235, 222, .52);

    font-size: 13px;

}


.btn-liquid-primary {

    position: relative;

    overflow: hidden;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    padding: 11px 18px;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.24);

    background:

        linear-gradient(

            135deg,

            rgba(183, 220, 168, .96),

            rgba(113, 166, 112, .86)

        );

    color: #102417 !important;

    font-weight: 700;

    font-size: 13px;

    text-decoration: none !important;

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.60),

        0 12px 30px rgba(72, 138, 88, .25);

    transition: .25s;

}


.btn-liquid-primary::before {

    content: "";

    position: absolute;

    width: 70%;

    height: 220%;

    top: -70%;

    left: -80%;

    transform: rotate(25deg);

    background:

        linear-gradient(

            90deg,

            transparent,

            rgba(255,255,255,.38),

            transparent

        );

    transition: .45s;

}


.btn-liquid-primary:hover {

    transform: translateY(-2px);

    color: #102417;

}


.btn-liquid-primary:hover::before {

    left: 130%;

}


.nutri-calendar-page {

    position: relative;

    min-height: 850px;

    padding-bottom: 40px;

}


.ambient {

    position: fixed;

    pointer-events: none;

    border-radius: 50%;

    filter: blur(90px);

    opacity: .22;

}


.ambient-one {

    width: 330px;

    height: 330px;

    top: 130px;

    right: 2%;

    background: #5b9465;

}


.ambient-two {

    width: 290px;

    height: 290px;

    bottom: 5%;

    left: 18%;

    background: #315f43;

}


.ambient-three {

    width: 180px;

    height: 180px;

    top: 520px;

    left: 3%;

    background: #8fba7a;

    opacity: .09;

}


.glass-alert {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 13px 17px;

    margin-bottom: 18px;

    border-radius: 15px;

    border: 1px solid rgba(156,215,164,.23);

    background: rgba(84,145,91,.13);

    backdrop-filter: blur(20px);

    color: #e1f4e3;

}


.glass-alert-icon {

    width: 34px;

    height: 34px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #a5d4a5;

    color: #17331f;

}


.glass-alert strong {

    display: block;

    font-size: 13px;

}


.glass-alert span {

    color: rgba(225,245,228,.65);

    font-size: 12px;

}


.calendar-hero {

    position: relative;

    z-index: 2;

    overflow: hidden;

    min-height: 190px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 32px 40px;

    border-radius: 27px;

    border: 1px solid rgba(255,255,255,.14);

    background:

        linear-gradient(

            135deg,

            rgba(255,255,255,.105),

            rgba(255,255,255,.03)

        );

    backdrop-filter:

        blur(28px)

        saturate(140%);

    -webkit-backdrop-filter:

        blur(28px)

        saturate(140%);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.17),

        0 25px 55px rgba(0,0,0,.20);

}


.calendar-hero::before {

    content: "";

    position: absolute;

    width: 500px;

    height: 150px;

    top: -100px;

    left: 15%;

    border-radius: 50%;

    background: rgba(255,255,255,.07);

    filter: blur(15px);

}


.hero-content {

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    gap: 24px;

}


.hero-icon {

    width: 76px;

    height: 76px;

    min-width: 76px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 23px;

    border: 1px solid rgba(255,255,255,.18);

    background:

        linear-gradient(

            145deg,

            rgba(172,208,158,.22),

            rgba(255,255,255,.05)

        );

    color: #b1d3a4;

    font-size: 29px;

    box-shadow:

        inset 0 1px 1px rgba(255,255,255,.16),

        0 15px 35px rgba(0,0,0,.14);

}


.hero-small {

    font-size: 10px;

    text-transform: uppercase;

    letter-spacing: 1.8px;

    color: #93b69b;

}


.hero-content h2 {

    margin: 6px 0 9px;

    color: #f4faf5;

    font-size: 33px;

    font-weight: 400;

}


.hero-content h2 span {

    color: #aacd9c;

    font-weight: 600;

}


.hero-content p {

    max-width: 550px;

    margin: 0;

    color: rgba(221,238,225,.54);

    font-size: 13px;

    line-height: 1.7;

}


.hero-decoration {

    position: relative;

    width: 230px;

    height: 150px;

}


.big-calendar-icon {

    position: absolute;

    right: 30px;

    bottom: -3px;

    color: rgba(166,203,151,.38);

    font-size: 108px;

}


.floating-glass {

    position: absolute;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 1px solid rgba(255,255,255,.17);

    background: rgba(255,255,255,.06);

    backdrop-filter: blur(15px);

    color: #a6cd9b;

    box-shadow:

        0 10px 25px rgba(0,0,0,.13);

}


.glass-leaf {

    width: 45px;

    height: 45px;

    border-radius: 15px;

    top: 12px;

    left: 16px;

}


.glass-clock {

    width: 38px;

    height: 38px;

    border-radius: 50%;

    right: 2px;

    top: 4px;

}


.calendar-stats {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns: repeat(4,1fr);

    gap: 14px;

    margin: 18px 0;

}


.liquid-stat {

    display: flex;

    align-items: center;

    gap: 13px;

    min-height: 90px;

    padding: 17px;

    border-radius: 20px;

    border: 1px solid rgba(255,255,255,.10);

    background:

        linear-gradient(

            135deg,

            rgba(255,255,255,.075),

            rgba(255,255,255,.022)

        );

    backdrop-filter: blur(20px);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.11),

        0 12px 25px rgba(0,0,0,.10);

}


.stat-icon {

    width: 46px;

    height: 46px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    background: rgba(145,187,138,.10);

    color: #a8cd9d;

}


.pending-icon {

    color: #e5c676;

}


.confirmed-icon {

    color: #91d49d;

}


.completed-icon {

    color: #8cc3c9;

}


.liquid-stat span {

    color: rgba(220,236,223,.43);

    font-size: 10px;

}


.liquid-stat h3 {

    margin: 2px 0 0;

    color: #f5faf6;

    font-size: 24px;

    font-weight: 600;

}


.calendar-layout {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:

        minmax(0, 1.65fr)

        minmax(280px, .65fr);

    gap: 18px;

}


.calendar-glass-card {

    padding: 27px;

    border-radius: 26px;

    border: 1px solid rgba(255,255,255,.12);

    background:

        linear-gradient(

            145deg,

            rgba(255,255,255,.09),

            rgba(255,255,255,.025)

        );

    backdrop-filter:

        blur(26px)

        saturate(135%);

    -webkit-backdrop-filter:

        blur(26px)

        saturate(135%);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.14),

        0 22px 50px rgba(0,0,0,.16);

}


.calendar-card-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 24px;

}


.calendar-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: rgba(174,205,178,.48);

    font-size: 9px;

    letter-spacing: 1.7px;

}


.calendar-card-header h3 {

    margin: 0;

    color: #f2faf4;

    font-size: 23px;

    font-weight: 600;

}


.calendar-controls {

    display: flex;

    align-items: center;

    gap: 7px;

}


.calendar-control {

    width: 38px;

    height: 38px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    border: 1px solid rgba(255,255,255,.12);

    background: rgba(255,255,255,.055);

    color: #b2c7b5;

    outline: none !important;

    transition: .2s;

}


.calendar-control:hover {

    background: #a6c99b;

    color: #102318;

    transform: translateY(-1px);

}


.today-button {

    height: 38px;

    padding: 0 15px;

    border-radius: 12px;

    border: 1px solid rgba(255,255,255,.12);

    background: rgba(143,187,136,.12);

    color: #acd0a6;

    font-size: 11px;

    outline: none !important;

}


.calendar-week,

.calendar-grid {

    display: grid;

    grid-template-columns:

        repeat(7, minmax(0, 1fr));

}


.calendar-week {

    margin-bottom: 7px;

}


.calendar-week div {

    padding: 8px;

    text-align: center;

    color: rgba(207,225,211,.34);

    font-size: 9px;

    font-weight: 700;

    letter-spacing: .7px;

}


.calendar-day {

    position: relative;

    min-height: 94px;

    margin: 3px;

    padding: 9px;

    overflow: hidden;

    border-radius: 15px;

    border: 1px solid transparent;

    background: rgba(255,255,255,.018);

    cursor: pointer;

    transition: .24s ease;

}


.calendar-day:hover {

    transform: translateY(-2px);

    border-color: rgba(165,205,158,.19);

    background: rgba(255,255,255,.055);

}


.calendar-day.other-month {

    opacity: .22;

}


.day-number {

    width: 28px;

    height: 28px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    color: rgba(234,244,236,.68);

    font-size: 11px;

}


.calendar-day.today {

    border-color: rgba(169,211,161,.25);

    background:

        linear-gradient(

            145deg,

            rgba(151,198,144,.14),

            rgba(255,255,255,.035)

        );

}


.calendar-day.today .day-number {

    background: #a9cc9d;

    color: #102417;

    font-weight: 700;

    box-shadow:

        0 6px 15px rgba(114,169,109,.23);

}


.calendar-day.has-event {

    background:

        linear-gradient(

            145deg,

            rgba(126,173,122,.10),

            rgba(255,255,255,.022)

        );

}


.calendar-event {

    margin-top: 5px;

    padding: 5px 7px;

    overflow: hidden;

    border-radius: 8px;

    background: rgba(136,184,132,.13);

    color: rgba(224,240,226,.72);

    font-size: 8px;

    white-space: nowrap;

    text-overflow: ellipsis;

}


.more-events {

    display: block;

    margin-top: 3px;

    padding-left: 4px;

    color: #9bc197;

    font-size: 8px;

}


.calendar-legend {

    display: flex;

    gap: 20px;

    margin-top: 22px;

    padding-top: 18px;

    border-top: 1px solid rgba(255,255,255,.07);

    color: rgba(211,228,214,.40);

    font-size: 9px;

}


.legend-dot {

    display: inline-block;

    width: 7px;

    height: 7px;

    margin-right: 6px;

    border-radius: 50%;

}


.appointment-color {

    background: #85ad81;

}


.today-color {

    background: #b1d2a7;

}


.multiple-color {

    background: #d7c276;

}


.side-panel {

    display: flex;

    flex-direction: column;

    gap: 18px;

}


.today-glass {

    overflow: hidden;

    position: relative;

    padding: 23px;

    border-radius: 24px;

    border: 1px solid rgba(255,255,255,.11);

    background:

        linear-gradient(

            145deg,

            rgba(160,202,151,.13),

            rgba(255,255,255,.03)

        );

    backdrop-filter: blur(24px);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.13),

        0 18px 40px rgba(0,0,0,.14);

}


.today-glass::after {

    content: "";

    position: absolute;

    width: 160px;

    height: 160px;

    right: -70px;

    bottom: -90px;

    border-radius: 50%;

    background:

        rgba(144,188,136,.12);

    filter: blur(10px);

}


.today-label {

    color: #8fb395;

    font-size: 9px;

    letter-spacing: 2px;

}


.today-date {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    gap: 15px;

    margin-top: 10px;

}


.today-number {

    font-size: 57px;

    line-height: 57px;

    font-weight: 300;

    color: #e9f5eb;

}


.today-date h4 {

    margin: 0;

    color: #b5d3b0;

    font-size: 17px;

}


.today-date p {

    margin: 3px 0 0;

    color: rgba(220,235,223,.42);

    font-size: 11px;

}


.today-message {

    position: relative;

    z-index: 2;

    display: flex;

    gap: 9px;

    margin-top: 20px;

    padding-top: 15px;

    border-top: 1px solid rgba(255,255,255,.07);

    color: rgba(215,231,218,.44);

    font-size: 10px;

    line-height: 1.5;

}


.today-message i {

    margin-top: 2px;

    color: #8fb88e;

}


.upcoming-glass {

    flex: 1;

    padding: 22px;

    border-radius: 24px;

    border: 1px solid rgba(255,255,255,.11);

    background:

        linear-gradient(

            145deg,

            rgba(255,255,255,.075),

            rgba(255,255,255,.023)

        );

    backdrop-filter: blur(24px);

    box-shadow:

        inset 0 1px 0 rgba(255,255,255,.12),

        0 18px 40px rgba(0,0,0,.13);

}


.upcoming-title {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 14px;

}


.upcoming-title span {

    color: rgba(190,215,194,.36);

    font-size: 8px;

    letter-spacing: 1.5px;

}


.upcoming-title h4 {

    margin: 3px 0 0;

    color: #f0f8f1;

    font-size: 17px;

}


.mini-calendar-icon {

    width: 38px;

    height: 38px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background: rgba(145,185,139,.10);

    color: #9fc398;

}


.upcoming-item {

    display: flex;

    gap: 12px;

    padding: 12px 0;

    border-top:

        1px solid rgba(255,255,255,.055);

}


.appointment-time {

    min-width: 48px;

    height: 52px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background: rgba(144,185,137,.09);

    border: 1px solid rgba(255,255,255,.07);

}


.appointment-time span {

    color: #b4d0af;

    font-size: 11px;

    font-weight: 600;

}


.appointment-time small {

    margin-top: 2px;

    color: rgba(214,230,216,.37);

    font-size: 8px;

}


.upcoming-info {

    min-width: 0;

    flex: 1;

}


.upcoming-info h5 {

    margin: 1px 0 3px;

    color: #eef7f0;

    font-size: 12px;

    font-weight: 600;

}


.upcoming-info p {

    overflow: hidden;

    margin: 0 0 5px;

    color: rgba(212,228,215,.42);

    font-size: 9px;

    white-space: nowrap;

    text-overflow: ellipsis;

}


.mini-status {

    display: inline-block;

    padding: 3px 7px;

    border-radius: 10px;

    font-size: 7px;

}


.mini-status.confirmed {

    background: rgba(99,174,111,.10);

    color: #9bd1a4;

}


.mini-status.pending {

    background: rgba(205,172,85,.09);

    color: #dbc373;

}


.mini-status.completed {

    background: rgba(95,166,176,.09);

    color: #93c5ca;

}


.mini-status.cancelled {

    background: rgba(199,93,93,.09);

    color: #d78b8b;

}


.new-appointment-glass {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    width: 100%;

    margin-top: 14px;

    padding: 10px;

    border-radius: 13px;

    border: 1px solid rgba(165,204,158,.15);

    background: rgba(145,187,139,.09);

    color: #aad0a5 !important;

    font-size: 10px;

    font-weight: 600;

    text-decoration: none !important;

    transition: .2s;

}


.new-appointment-glass:hover {

    background: #a7ca9d;

    color: #112518 !important;

}


.empty-upcoming {

    padding: 27px 8px;

    text-align: center;

}


.empty-upcoming > div {

    width: 50px;

    height: 50px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: auto auto 10px;

    border-radius: 17px;

    background: rgba(255,255,255,.05);

    color: #9fc097;

}


.empty-upcoming h5 {

    color: #edf6ee;

    font-size: 13px;

}


.empty-upcoming p {

    color: rgba(211,229,214,.38);

    font-size: 9px;

}


.selected-day-panel {

    position: relative;

    z-index: 2;

    margin-top: 18px;

    padding: 24px;

    border-radius: 25px;

    border: 1px solid rgba(255,255,255,.10);

    background:

        linear-gradient(

            145deg,

            rgba(255,255,255,.07),

            rgba(255,255,255,.02)

        );

    backdrop-filter: blur(24px);

    box-shadow:

        0 18px 40px rgba(0,0,0,.11);

}


.selected-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding-bottom: 16px;

    border-bottom:

        1px solid rgba(255,255,255,.06);

}


.selected-header span {

    color: rgba(189,214,193,.35);

    font-size: 8px;

    letter-spacing: 1.5px;

}


.selected-header h4 {

    margin: 3px 0 0;

    color: #f0f8f2;

    font-size: 17px;

}


.selected-icon {

    width: 42px;

    height: 42px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background: rgba(145,186,139,.10);

    color: #a5c99d;

}


.selected-appointments {

    display: grid;

    grid-template-columns:

        repeat(3,minmax(0,1fr));

    gap: 12px;

    padding-top: 17px;

}


.selected-appointment {

    padding: 15px;

    border-radius: 17px;

    border:

        1px solid rgba(255,255,255,.08);

    background:

        rgba(255,255,255,.035);

}


.selected-appointment-time {

    color: #a8ca9f;

    font-size: 10px;

    font-weight: 600;

}


.selected-appointment h5 {

    margin: 7px 0 4px;

    color: #edf7ef;

    font-size: 13px;

}


.selected-appointment p {

    margin: 0;

    color: rgba(214,229,216,.42);

    font-size: 9px;

}


.selected-status {

    display: inline-block;

    margin-top: 10px;

    padding: 4px 8px;

    border-radius: 10px;

    background:

        rgba(143,184,137,.10);

    color: #9fc399;

    font-size: 8px;

}


.appointment-actions {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 7px;

    margin-top: 14px;

}


.appointment-action {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    min-height: 31px;

    padding: 6px 10px;

    border-radius: 10px;

    border: 1px solid rgba(255,255,255,.10);

    font-size: 8px;

    font-weight: 600;

    text-decoration: none !important;

    outline: none !important;

    cursor: pointer;

    transition: .2s;

}


.appointment-action.edit {

    background:

        rgba(140, 184, 137, .10);

    color: #afd0a8 !important;

}

.appointment-action.edit:hover {

    background: #a7ca9d;

    color: #102417 !important;

    transform: translateY(-1px);

}


.appointment-action.cancel {

    background:

        rgba(218, 177, 82, .09);

    color: #e0c578;

}

.appointment-action.cancel:hover {

    background: #d5bc71;

    color: #211c0c;

    transform: translateY(-1px);

}


.appointment-action.delete {

    background:

        rgba(205, 88, 88, .09);

    color: #dd9696;

}

.appointment-action.delete:hover {

    background: #bc6666;

    color: white;

    transform: translateY(-1px);

}


.appointment-action-form {

    margin: 0;

    display: inline-flex;

}


.select-day-message {

    grid-column: 1 / -1;

    padding: 25px;

    text-align: center;

    color: rgba(216,231,218,.35);

}


.select-day-message i {

    margin-bottom: 8px;

    color: #87a989;

    font-size: 21px;

}


.select-day-message p {

    margin: 0;

    font-size: 10px;

}


@media(max-width: 1100px) {

    .calendar-layout {

        grid-template-columns: 1fr;

    }


    .side-panel {

        display: grid;

        grid-template-columns: 1fr 1fr;

    }


    .calendar-stats {

        grid-template-columns:

            repeat(2,1fr);

    }

}


@media(max-width: 767px) {

    .appointments-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .calendar-hero {

        padding: 26px 21px;

    }


    .hero-decoration {

        display: none;

    }


    .hero-content {

        align-items: flex-start;

    }


    .hero-icon {

        width: 58px;

        min-width: 58px;

        height: 58px;

        border-radius: 18px;

        font-size: 21px;

    }


    .hero-content h2 {

        font-size: 25px;

    }


    .calendar-stats {

        grid-template-columns: 1fr 1fr;

    }


    .calendar-glass-card {

        padding: 18px 10px;

    }


    .calendar-day {

        min-height: 64px;

        margin: 1px;

        padding: 5px;

        border-radius: 10px;

    }


    .calendar-event {

        display: none;

    }


    .calendar-day.has-event::after {

        content: "";

        position: absolute;

        width: 5px;

        height: 5px;

        bottom: 7px;

        left: 50%;

        transform: translateX(-50%);

        border-radius: 50%;

        background: #9cc696;

    }


    .side-panel {

        grid-template-columns: 1fr;

    }


    .selected-appointments {

        grid-template-columns: 1fr;

    }


    .calendar-legend {

        flex-wrap: wrap;

    }

}

</style>

@stop


@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {


    const appointments = @json($calendarAppointments);


    const calendarGrid =

        document.getElementById('calendarGrid');

    const calendarTitle =

        document.getElementById('calendarTitle');

    const selectedDayTitle =

        document.getElementById('selectedDayTitle');

    const selectedAppointments =

        document.getElementById('selectedAppointments');


    const today =

        new Date();


    let currentDate =

        new Date(

            today.getFullYear(),

            today.getMonth(),

            1

        );


    const months = [

        'Enero',

        'Febrero',

        'Marzo',

        'Abril',

        'Mayo',

        'Junio',

        'Julio',

        'Agosto',

        'Septiembre',

        'Octubre',

        'Noviembre',

        'Diciembre'

    ];


    const days = [

        'Domingo',

        'Lunes',

        'Martes',

        'Miércoles',

        'Jueves',

        'Viernes',

        'Sábado'

    ];


    document.getElementById('todayNumber')

        .textContent =

        today.getDate();


    document.getElementById('todayDay')

        .textContent =

        days[today.getDay()];


    document.getElementById('todayMonth')

        .textContent =

        months[today.getMonth()] +

        ' ' +

        today.getFullYear();


    function dateKey(year, month, day) {

        return (

            year +

            '-' +

            String(month + 1).padStart(2,'0') +

            '-' +

            String(day).padStart(2,'0')

        );

    }


    function getAppointmentsForDay(

        year,

        month,

        day

    ) {

        const key =

            dateKey(

                year,

                month,

                day

            );


        return appointments.filter(function (appointment) {

            return appointment.date

                .substring(0,10) === key;

        });

    }


    function renderCalendar() {


        calendarGrid.innerHTML = '';


        const year =

            currentDate.getFullYear();

        const month =

            currentDate.getMonth();


        calendarTitle.textContent =

            months[month] + ' ' + year;


        const firstDay =

            new Date(

                year,

                month,

                1

            );


        const lastDay =

            new Date(

                year,

                month + 1,

                0

            );


        const daysInMonth =

            lastDay.getDate();


        let startingDay =

            firstDay.getDay();

        startingDay =

            startingDay === 0

                ? 6

                : startingDay - 1;


        const previousMonthLastDay =

            new Date(

                year,

                month,

                0

            ).getDate();


        for (

            let i = startingDay - 1;

            i >= 0;

            i--

        ) {

            const day =

                previousMonthLastDay - i;


            createDayElement(

                day,

                true,

                year,

                month - 1

            );

        }


        for (

            let day = 1;

            day <= daysInMonth;

            day++

        ) {

            createDayElement(

                day,

                false,

                year,

                month

            );

        }


        const cells =

            calendarGrid.children.length;


        const remaining =

            42 - cells;


        for (

            let day = 1;

            day <= remaining;

            day++

        ) {

            createDayElement(

                day,

                true,

                year,

                month + 1

            );

        }

    }


    function createDayElement(

        day,

        otherMonth,

        year,

        month

    ) {


        const realDate =

            new Date(

                year,

                month,

                day

            );


        const realYear =

            realDate.getFullYear();

        const realMonth =

            realDate.getMonth();

        const realDay =

            realDate.getDate();


        const dayAppointments =

            getAppointmentsForDay(

                realYear,

                realMonth,

                realDay

            );


        const element =

            document.createElement('div');


        element.className =

            'calendar-day';


        if (otherMonth) {

            element.classList.add(

                'other-month'

            );

        }


        const isToday =

            realDay === today.getDate() &&

            realMonth === today.getMonth() &&

            realYear === today.getFullYear();


        if (isToday) {

            element.classList.add('today');

        }


        if (dayAppointments.length > 0) {

            element.classList.add(

                'has-event'

            );

        }


        let html =

            '<div class="day-number">' +

            realDay +

            '</div>';


        dayAppointments

            .slice(0,2)

            .forEach(function (appointment) {


                const time =

                    appointment.date

                        .substring(11,16);


                html +=

                    '<div class="calendar-event">' +

                        time +

                        ' · ' +

                        appointment.patient +

                    '</div>';

            });


        if (dayAppointments.length > 2) {

            html +=

                '<span class="more-events">' +

                    '+' +

                    (dayAppointments.length - 2) +

                    ' más' +

                '</span>';

        }


        element.innerHTML = html;


        element.addEventListener(

            'click',

            function () {

                showDayAppointments(

                    realDate,

                    dayAppointments

                );

            }

        );


        calendarGrid.appendChild(

            element

        );

    }


    function showDayAppointments(date, dayAppointments) {

        selectedDayTitle.textContent =
            date.getDate() +
            ' de ' +
            months[date.getMonth()] +
            ' de ' +
            date.getFullYear();

        if (dayAppointments.length === 0) {
            selectedAppointments.innerHTML = `
                <div class="select-day-message">
                    <i class="far fa-calendar"></i>
                    <p>No hay citas programadas para este día.</p>
                </div>
            `;
            return;
        }

        const csrfToken = @json(csrf_token());
        let html = '';

        dayAppointments.forEach(function (appointment) {
            const time = appointment.date.substring(11, 16);

            let cancelButton = '';

            if (
                appointment.status !== 'Cancelada' &&
                appointment.status !== 'Completada'
            ) {
                cancelButton = `
                    <form
                        method="POST"
                        action="${appointment.cancel_url}"
                        class="appointment-action-form"
                        onsubmit="return confirm('¿Deseas cancelar esta cita?');"
                    >
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PATCH">

                        <button
                            type="submit"
                            class="appointment-action cancel"
                        >
                            <i class="fas fa-ban"></i>
                            Cancelar
                        </button>
                    </form>
                `;
            }

            html += `
                <div class="selected-appointment">
                    <span class="selected-appointment-time">${time}</span>

                    <h5>${appointment.patient}</h5>
                    <p>${appointment.reason}</p>

                    <span class="selected-status">
                        ${appointment.status}
                    </span>

                    <div class="appointment-actions">
                        <a
                            href="${appointment.edit_url}"
                            class="appointment-action edit"
                        >
                            <i class="fas fa-pen"></i>
                            Editar
                        </a>

                        ${cancelButton}

                        <form
                            method="POST"
                            action="${appointment.delete_url}"
                            class="appointment-action-form"
                            onsubmit="return confirm('¿Eliminar esta cita definitivamente? Esta acción no se puede deshacer.');"
                        >
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">

                            <button
                                type="submit"
                                class="appointment-action delete"
                            >
                                <i class="fas fa-trash"></i>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            `;
        });

        selectedAppointments.innerHTML = html;
    }


    document

        .getElementById('prevMonth')

        .addEventListener(

            'click',

            function () {


                currentDate =

                    new Date(

                        currentDate.getFullYear(),

                        currentDate.getMonth() - 1,

                        1

                    );


                renderCalendar();

            }

        );


    document

        .getElementById('nextMonth')

        .addEventListener(

            'click',

            function () {


                currentDate =

                    new Date(

                        currentDate.getFullYear(),

                        currentDate.getMonth() + 1,

                        1

                    );


                renderCalendar();

            }

        );


    document

        .getElementById('todayButton')

        .addEventListener(

            'click',

            function () {


                currentDate =

                    new Date(

                        today.getFullYear(),

                        today.getMonth(),

                        1

                    );


                renderCalendar();

            }

        );


    renderCalendar();

});

</script>

@stop