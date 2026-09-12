@extends('adminlte::page')

@section('title', 'Consultas | NutriAdmin')


@section('content_header')

<div class="consultations-header">

    <div>

        <span class="consultation-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN
        </span>

        <h1>Consultas</h1>

        <p>
            Registra y consulta el historial clínico de tus pacientes.
        </p>

    </div>


    <a
        href="{{ route('consultas.create') }}"
        class="btn-consultation-primary"
    >
        <i class="fas fa-plus"></i>

        Nueva consulta
    </a>

</div>

@stop



@section('content')

<div class="consultations-page">


    @if(session('success'))

        <div class="consultation-alert">

            <i class="fas fa-check-circle"></i>

            {{ session('success') }}

        </div>

    @endif



    {{-- MÉTRICAS --}}

    <div class="consultation-stats">


        <div class="consultation-stat">

            <div class="consultation-stat-icon">

                <i class="fas fa-stethoscope"></i>

            </div>

            <div>

                <span>
                    Consultas del mes
                </span>

                <h3>
                    {{ $consultationsThisMonth }}
                </h3>

            </div>

        </div>



        <div class="consultation-stat">

            <div class="consultation-stat-icon today">

                <i class="far fa-calendar-check"></i>

            </div>

            <div>

                <span>
                    Consultas de hoy
                </span>

                <h3>
                    {{ $consultationsToday }}
                </h3>

            </div>

        </div>



        <div class="consultation-stat">

            <div class="consultation-stat-icon patients">

                <i class="fas fa-user-check"></i>

            </div>

            <div>

                <span>
                    Pacientes atendidos
                </span>

                <h3>
                    {{ $patientsAttended }}
                </h3>

            </div>

        </div>


    </div>



    {{-- HISTORIAL --}}

    <div class="consultations-card">


        <div class="consultations-card-header">

            <div>

                <span>
                    HISTORIAL CLÍNICO
                </span>

                <h4>
                    Consultas registradas
                </h4>

            </div>


            <i class="fas fa-notes-medical"></i>

        </div>



        @if($consultations->isEmpty())


            <div class="empty-consultations">

                <i class="fas fa-stethoscope"></i>

                <h5>
                    Sin consultas registradas
                </h5>

                <p>
                    Cuando atiendas a un paciente,
                    registra aquí la consulta.
                </p>

                <a href="{{ route('consultas.create') }}">
                    Registrar primera consulta
                </a>

            </div>


        @else


            <div class="consultations-list">


                @foreach($consultations as $consultation)

                    <div class="consultation-item">


                        <div class="consultation-date">

                            <strong>
                                {{ $consultation->consultation_at->format('d') }}
                            </strong>

                            <span>
                                {{ strtoupper(
                                    $consultation->consultation_at
                                        ->locale('es')
                                        ->translatedFormat('M')
                                ) }}
                            </span>

                        </div>



                        <div class="consultation-info">

                            <h5>

                                {{ $consultation->patient->first_name }}
                                {{ $consultation->patient->last_name }}

                            </h5>

                            <p>

                                {{ $consultation->reason
                                    ?? 'Consulta nutricional' }}

                            </p>


                            <div class="consultation-meta">

                                <span>

                                    <i class="far fa-clock"></i>

                                    {{
                                        $consultation
                                            ->consultation_at
                                            ->format('H:i')
                                    }}

                                </span>


                                @if($consultation->next_visit)

                                    <span>

                                        <i class="far fa-calendar"></i>

                                        Próxima:

                                        {{
                                            $consultation
                                                ->next_visit
                                                ->format('d/m/Y')
                                        }}

                                    </span>

                                @endif

                            </div>

                        </div>



                        <div class="consultation-actions">

                            <button
                                class="consultation-view-disabled"
                                type="button"
                            >

                                <i class="fas fa-eye"></i>

                                Ver consulta

                            </button>

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

<style>

body {

    background:

        radial-gradient(
            circle at 14% 12%,
            rgba(66,121,81,.20),
            transparent 30%
        ),

        radial-gradient(
            circle at 88% 45%,
            rgba(85,145,123,.12),
            transparent 30%
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


/* HEADER */

.consultations-header {

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

}

.consultation-eyebrow {

    color: #8eb59a;

    font-size: 10px;
    font-weight: 700;

    letter-spacing: 2px;

}

.consultations-header h1 {

    margin: 4px 0;

    color: #f3faf4;

    font-size: 32px;

}

.consultations-header p {

    margin: 0;

    color: rgba(220,235,223,.48);

    font-size: 13px;

}


/* BOTÓN */

.btn-consultation-primary {

    display: inline-flex;
    align-items: center;

    gap: 8px;

    padding: 11px 18px;

    border-radius: 14px;

    background:
        linear-gradient(
            135deg,
            #b2d3aa,
            #78a68a
        );

    color: #102417 !important;

    font-size: 12px;
    font-weight: 700;

    text-decoration: none !important;

}


/* ALERT */

.consultation-alert {

    margin-bottom: 17px;

    padding: 13px 16px;

    border-radius: 14px;

    border:
        1px solid rgba(119,190,130,.18);

    background:
        rgba(86,157,97,.11);

    color: #b8deb9;

}


/* STATS */

.consultation-stats {

    display: grid;

    grid-template-columns:
        repeat(3,minmax(0,1fr));

    gap: 14px;

    margin-bottom: 18px;

}

.consultation-stat {

    display: flex;
    align-items: center;

    gap: 14px;

    padding: 18px;

    min-height: 94px;

    border-radius: 20px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.045);

    backdrop-filter:
        blur(20px);

}

.consultation-stat-icon {

    width: 48px;
    height: 48px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background:
        rgba(136,184,139,.10);

    color: #a7ce9f;

}

.consultation-stat-icon.today {

    color: #8fc5bd;

}

.consultation-stat-icon.patients {

    color: #d8c172;

}

.consultation-stat span {

    color:
        rgba(215,232,218,.42);

    font-size: 9px;

}

.consultation-stat h3 {

    margin: 3px 0 0;

    color: #f3f9f4;

    font-size: 25px;

}


/* CONTENEDOR */

.consultations-card {

    padding: 24px;

    border-radius: 24px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.04);

    backdrop-filter:
        blur(22px);

}

.consultations-card-header {

    display: flex;

    align-items: center;
    justify-content: space-between;

    padding-bottom: 18px;

    border-bottom:
        1px solid rgba(255,255,255,.06);

}

.consultations-card-header span {

    color:
        rgba(190,214,194,.35);

    font-size: 8px;

    letter-spacing: 1.5px;

}

.consultations-card-header h4 {

    margin: 4px 0 0;

    color: #eff7f0;

    font-size: 18px;

}

.consultations-card-header > i {

    color: #9fc5ad;

    font-size: 23px;

}


/* CONSULTA */

.consultation-item {

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 17px 2px;

    border-bottom:
        1px solid rgba(255,255,255,.055);

}

.consultation-date {

    width: 53px;
    height: 58px;

    flex-shrink: 0;

    display: flex;

    flex-direction: column;

    align-items: center;
    justify-content: center;

    border-radius: 15px;

    background:
        rgba(141,187,140,.09);

    border:
        1px solid rgba(255,255,255,.07);

}

.consultation-date strong {

    color: #c0dabc;

    font-size: 17px;

}

.consultation-date span {

    color:
        rgba(212,230,215,.38);

    font-size: 7px;

}

.consultation-info {

    flex: 1;

}

.consultation-info h5 {

    margin: 0 0 4px;

    color: #eef7f0;

    font-size: 13px;

}

.consultation-info p {

    margin: 0 0 6px;

    color:
        rgba(214,230,217,.45);

    font-size: 10px;

}

.consultation-meta {

    display: flex;

    gap: 15px;

}

.consultation-meta span {

    color:
        rgba(208,226,211,.34);

    font-size: 8px;

}

.consultation-meta i {

    margin-right: 3px;

    color: #8faf91;

}


/* ACCIONES */

.consultation-view-disabled {

    padding: 8px 12px;

    border-radius: 11px;

    border:
        1px solid rgba(255,255,255,.08);

    background:
        rgba(143,185,139,.09);

    color: #aacaa5;

    font-size: 9px;

}


/* VACÍO */

.empty-consultations {

    padding: 65px 20px;

    text-align: center;

    color:
        rgba(214,231,217,.40);

}

.empty-consultations > i {

    margin-bottom: 13px;

    color: #9abb98;

    font-size: 37px;

}

.empty-consultations h5 {

    color: #edf6ee;

}

.empty-consultations a {

    display: inline-block;

    margin-top: 12px;

    color: #abd0a5;

}


/* RESPONSIVE */

@media(max-width: 700px) {

    .consultations-header {

        align-items: flex-start;
        flex-direction: column;

    }

    .consultation-stats {

        grid-template-columns: 1fr;

    }

    .consultation-item {

        align-items: flex-start;

    }

}

</style>

@stop