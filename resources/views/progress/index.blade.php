@extends('adminlte::page')

@section('title', 'Progreso | NutriAdmin')


@section('content_header')

<div class="progress-header">

    <div>

        <span class="progress-eyebrow">

            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN

        </span>

        <h1>
            Progreso
        </h1>

        <p>
            Consulta la evolución de tus pacientes.
        </p>

    </div>

</div>

@stop



@section('content')


<div class="progress-page">


    {{-- =====================================
         MÉTRICAS
    ====================================== --}}

    <div class="progress-stats">


        <div class="progress-stat">

            <div class="progress-stat-icon">

                <i class="fas fa-user-check"></i>

            </div>

            <div>

                <span>
                    Con seguimiento
                </span>

                <h3>
                    {{ $patientsWithProgress }}
                </h3>

            </div>

        </div>



        <div class="progress-stat">

            <div class="progress-stat-icon">

                <i class="fas fa-clipboard-list"></i>

            </div>

            <div>

                <span>
                    Evaluaciones
                </span>

                <h3>
                    {{ $totalEvaluations }}
                </h3>

            </div>

        </div>



        <div class="progress-stat">

            <div class="progress-stat-icon comparison">

                <i class="fas fa-chart-line"></i>

            </div>

            <div>

                <span>
                    Con comparativa
                </span>

                <h3>
                    {{ $patientsWithComparison }}
                </h3>

            </div>

        </div>


    </div>



    {{-- =====================================
         PACIENTES
    ====================================== --}}

    <div class="progress-panel">


        <div class="progress-panel-header">

            <div>

                <span>
                    SEGUIMIENTO
                </span>

                <h4>
                    Evolución de pacientes
                </h4>

            </div>


            <div class="panel-icon">

                <i class="fas fa-chart-area"></i>

            </div>

        </div>



        @if($progressPatients->isEmpty())


            <div class="progress-empty">

                <i class="fas fa-chart-line"></i>

                <h5>
                    Sin pacientes
                </h5>

                <p>
                    Registra pacientes para comenzar
                    a visualizar su progreso.
                </p>

            </div>


        @else


            <div class="progress-grid">


                @foreach($progressPatients as $item)

                    @php

                        $patient = $item['patient'];

                        $latest = $item['latest'];

                        $weightChange =
                            $item['weight_change'];

                        $fatChange =
                            $item['fat_change'];

                        $muscleChange =
                            $item['muscle_change'];

                    @endphp


                    <div class="patient-progress-card">


                        {{-- PACIENTE --}}

                        <div class="progress-patient-header">


                            <div class="patient-progress-avatar">

                                {{ strtoupper(
                                    substr(
                                        $patient->first_name,
                                        0,
                                        1
                                    )
                                ) }}

                                {{ strtoupper(
                                    substr(
                                        $patient->last_name,
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div>

                                <h5>

                                    {{ $patient->first_name }}
                                    {{ $patient->last_name }}

                                </h5>


                                @if($latest)

                                    <p>

                                        Última evaluación:

                                        {{
                                            $latest
                                                ->evaluation_date
                                                ->format('d/m/Y')
                                        }}

                                    </p>

                                @else

                                    <p>
                                        Sin evaluaciones
                                    </p>

                                @endif

                            </div>


                            <span class="evaluation-counter">

                                {{ $item['evaluation_count'] }}

                                eval.

                            </span>

                        </div>



                        @if($latest)


                            <div class="patient-progress-data">


                                {{-- PESO --}}

                                <div>

                                    <span>
                                        Peso actual
                                    </span>

                                    <strong>

                                        {{
                                            number_format(
                                                $latest->weight,
                                                1
                                            )
                                        }}

                                        kg

                                    </strong>

                                </div>



                                {{-- CAMBIO PESO --}}

                                <div>

                                    <span>
                                        Cambio peso
                                    </span>

                                    <strong
                                        class="{{
                                            !is_null($weightChange)
                                                && $weightChange < 0
                                                ? 'change-down'
                                                : 'change-up'
                                        }}"
                                    >

                                        @if(is_null($weightChange))

                                            —

                                        @elseif($weightChange > 0)

                                            +{{ $weightChange }} kg

                                        @else

                                            {{ $weightChange }} kg

                                        @endif

                                    </strong>

                                </div>



                                {{-- GRASA --}}

                                <div>

                                    <span>
                                        Grasa corporal
                                    </span>

                                    <strong>

                                        @if(!is_null($latest->body_fat))

                                            {{
                                                number_format(
                                                    $latest->body_fat,
                                                    1
                                                )
                                            }}%

                                        @else

                                            —

                                        @endif

                                    </strong>

                                </div>



                                {{-- CAMBIO GRASA --}}

                                <div>

                                    <span>
                                        Cambio grasa
                                    </span>

                                    <strong
                                        class="{{
                                            !is_null($fatChange)
                                                && $fatChange < 0
                                                ? 'change-down'
                                                : 'change-up'
                                        }}"
                                    >

                                        @if(is_null($fatChange))

                                            —

                                        @elseif($fatChange > 0)

                                            +{{ $fatChange }}%

                                        @else

                                            {{ $fatChange }}%

                                        @endif

                                    </strong>

                                </div>


                            </div>


                            @if($item['evaluation_count'] < 2)

                                <div class="comparison-warning">

                                    <i class="fas fa-info-circle"></i>

                                    Se necesita otra evaluación
                                    para comparar el progreso.

                                </div>

                            @endif


                        @else


                            <div class="no-progress">

                                <i class="fas fa-chart-line"></i>

                                Este paciente aún no tiene
                                evaluaciones registradas.

                            </div>


                        @endif



                        {{-- BOTONES --}}

                        <div class="progress-card-actions">


                            <a
                                href="{{ route('progreso.show', $patient) }}"
                                class="progress-view-button"
                            >

                                <i class="fas fa-chart-line"></i>

                                Ver progreso

                            </a>


                            <a
                                href="{{ route('evaluaciones.create', $patient) }}"
                                class="progress-add-button"
                            >

                                <i class="fas fa-plus"></i>

                                Evaluación

                            </a>


                        </div>


                    </div>


                @endforeach


            </div>


        @endif


    </div>


</div>

@stop



@section('css')

<link
    rel="stylesheet"
    href="{{ asset('css/nutriadmin.css') }}"
>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

<style>


/* =========================================================
   FONDO
========================================================= */

body {

    background:

        radial-gradient(
            circle at 14% 12%,
            rgba(65, 121, 81, .20),
            transparent 30%
        ),

        radial-gradient(
            circle at 88% 48%,
            rgba(93, 151, 99, .12),
            transparent 28%
        ),

        linear-gradient(
            135deg,
            #08170f,
            #10251a,
            #091911
        ) !important;

}


.content-wrapper {

    background: transparent !important;

}



/* =========================================================
   HEADER
========================================================= */

.progress-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

}


.progress-eyebrow {

    color: #8eb59a;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 2px;

}


.progress-header h1 {

    margin: 4px 0;

    color: #f3faf4;

    font-size: 32px;

}


.progress-header p {

    margin: 0;

    color: rgba(220,235,223,.48);

    font-size: 13px;

}



/* =========================================================
   MÉTRICAS
========================================================= */

.progress-stats {

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0,1fr));

    gap: 15px;

    margin-bottom: 18px;

}


.progress-stat {

    display: flex;

    align-items: center;

    gap: 14px;

    min-height: 95px;

    padding: 18px;

    border-radius: 21px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.045);

    backdrop-filter: blur(20px);

}


.progress-stat-icon {

    width: 48px;

    height: 48px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    border-radius: 16px;

    background:
        rgba(133,184,133,.10);

    color: #a9cfa2;

}


.progress-stat-icon.comparison {

    color: #d9c273;

}


.progress-stat span {

    color: rgba(217,233,220,.42);

    font-size: 9px;

}


.progress-stat h3 {

    margin: 3px 0 0;

    color: #f5faf6;

    font-size: 25px;

}



/* =========================================================
   PANEL
========================================================= */

.progress-panel {

    padding: 24px;

    border-radius: 25px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.04);

    backdrop-filter: blur(22px);

}


.progress-panel-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding-bottom: 18px;

    margin-bottom: 18px;

    border-bottom:
        1px solid rgba(255,255,255,.06);

}


.progress-panel-header span {

    color: rgba(191,214,195,.36);

    font-size: 8px;

    letter-spacing: 1.5px;

}


.progress-panel-header h4 {

    margin: 4px 0 0;

    color: #eff7f0;

    font-size: 18px;

}


.panel-icon {

    width: 44px;

    height: 44px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    background:
        rgba(145,186,139,.10);

    color: #a7c99f;

}



/* =========================================================
   GRID
========================================================= */

.progress-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0,1fr));

    gap: 15px;

}


.patient-progress-card {

    padding: 19px;

    border-radius: 20px;

    border:
        1px solid rgba(255,255,255,.085);

    background:
        rgba(255,255,255,.035);

    transition: .2s;

}


.patient-progress-card:hover {

    transform: translateY(-2px);

    border-color:
        rgba(164,205,157,.18);

}



/* =========================================================
   PACIENTE
========================================================= */

.progress-patient-header {

    position: relative;

    display: flex;

    align-items: center;

    gap: 12px;

    padding-bottom: 15px;

    border-bottom:
        1px solid rgba(255,255,255,.055);

}


.patient-progress-avatar {

    width: 44px;

    height: 44px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    border-radius: 14px;

    background:
        linear-gradient(
            135deg,
            #9cc191,
            #658e6c
        );

    color: #102417;

    font-size: 11px;

    font-weight: 700;

}


.progress-patient-header h5 {

    margin: 0 0 3px;

    color: #f0f7f1;

    font-size: 13px;

}


.progress-patient-header p {

    margin: 0;

    color: rgba(216,231,218,.40);

    font-size: 9px;

}


.evaluation-counter {

    margin-left: auto;

    padding: 5px 9px;

    border-radius: 11px;

    background:
        rgba(143,184,137,.09);

    color: #9fc399;

    font-size: 8px;

}



/* =========================================================
   DATOS
========================================================= */

.patient-progress-data {

    display: grid;

    grid-template-columns:
        repeat(2,1fr);

    gap: 12px;

    padding: 16px 0;

}


.patient-progress-data > div {

    padding: 11px;

    border-radius: 14px;

    background:
        rgba(255,255,255,.025);

}


.patient-progress-data span {

    display: block;

    margin-bottom: 4px;

    color: rgba(213,230,216,.38);

    font-size: 8px;

}


.patient-progress-data strong {

    color: #edf6ef;

    font-size: 13px;

}


.change-down {

    color: #91cf9c !important;

}


.change-up {

    color: #d9bb72 !important;

}



/* =========================================================
   AVISO
========================================================= */

.comparison-warning {

    margin-bottom: 15px;

    padding: 9px 11px;

    border-radius: 12px;

    background:
        rgba(209,177,90,.07);

    color: #c9b66f;

    font-size: 8px;

}


.no-progress {

    padding: 28px 10px;

    text-align: center;

    color: rgba(214,230,216,.40);

    font-size: 9px;

}


.no-progress i {

    display: block;

    margin-bottom: 7px;

    color: #91ae91;

    font-size: 19px;

}



/* =========================================================
   BOTONES
========================================================= */

.progress-card-actions {

    display: flex;

    gap: 8px;

    padding-top: 13px;

    border-top:
        1px solid rgba(255,255,255,.055);

}


.progress-view-button,
.progress-add-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    padding: 8px 11px;

    border-radius: 11px;

    font-size: 8px;

    font-weight: 600;

    text-decoration: none !important;

}


.progress-view-button {

    flex: 1;

    background:
        rgba(142,187,137,.10);

    color: #abd0a5 !important;

}


.progress-view-button:hover {

    background: #a7ca9d;

    color: #102417 !important;

}


.progress-add-button {

    border:
        1px solid rgba(255,255,255,.09);

    color:
        rgba(221,236,223,.58) !important;

}



/* =========================================================
   VACÍO
========================================================= */

.progress-empty {

    padding: 60px 20px;

    text-align: center;

    color: rgba(215,231,218,.40);

}


.progress-empty i {

    margin-bottom: 12px;

    color: #91ad91;

    font-size: 36px;

}


.progress-empty h5 {

    color: #edf6ef;

}



/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 900px) {

    .progress-grid {

        grid-template-columns: 1fr;

    }

}


@media(max-width: 700px) {

    .progress-stats {

        grid-template-columns: 1fr;

    }

}


</style>

@stop