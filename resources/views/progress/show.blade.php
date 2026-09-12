@extends('adminlte::page')

@section('title', 'Progreso del paciente | NutriAdmin')


@section('content_header')

<div class="progress-detail-header">

    <div>

        <span class="progress-eyebrow">
            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN
        </span>

        <h1>
            {{ $paciente->first_name }}
            {{ $paciente->last_name }}
        </h1>

        <p>
            Evolución y seguimiento nutricional.
        </p>

    </div>


    <div class="d-flex">

        <a
            href="{{ route('evaluaciones.create', $paciente) }}"
            class="btn-progress-add mr-2"
        >
            <i class="fas fa-plus"></i>
            Nueva evaluación
        </a>

        <a
            href="{{ route('progreso.index') }}"
            class="btn-progress-back"
        >
            <i class="fas fa-arrow-left"></i>
            Regresar
        </a>

    </div>

</div>

@stop



@section('content')

<div class="progress-detail-page">


    @if($evaluations->isEmpty())

        <div class="progress-empty-detail">

            <i class="fas fa-chart-line"></i>

            <h4>
                Sin información de progreso
            </h4>

            <p>
                Registra la primera evaluación de este paciente.
            </p>

            <a href="{{ route('evaluaciones.create', $paciente) }}">
                Registrar evaluación
            </a>

        </div>

    @else


        {{-- MÉTRICAS --}}

        <div class="detail-stats">


            <div class="detail-stat">

                <span>Peso actual</span>

                <strong>
                    {{ number_format($latestEvaluation->weight, 1) }}
                    kg
                </strong>

                <small>
                    @if(!is_null($weightChange))

                        {{ $weightChange > 0 ? '+' : '' }}
                        {{ $weightChange }} kg

                        desde el inicio

                    @else
                        Sin comparativa
                    @endif
                </small>

            </div>



            <div class="detail-stat">

                <span>Grasa corporal</span>

                <strong>

                    @if(!is_null($latestEvaluation->body_fat))

                        {{ number_format($latestEvaluation->body_fat, 1) }}%

                    @else

                        —

                    @endif

                </strong>

                <small>

                    @if(!is_null($fatChange))

                        {{ $fatChange > 0 ? '+' : '' }}
                        {{ $fatChange }}%

                        desde el inicio

                    @else
                        Sin comparativa
                    @endif

                </small>

            </div>



            <div class="detail-stat">

                <span>Masa muscular</span>

                <strong>

                    @if(!is_null($latestEvaluation->muscle_mass))

                        {{ number_format($latestEvaluation->muscle_mass, 1) }}
                        kg

                    @else

                        —

                    @endif

                </strong>

                <small>

                    @if(!is_null($muscleChange))

                        {{ $muscleChange > 0 ? '+' : '' }}
                        {{ $muscleChange }} kg

                        desde el inicio

                    @else
                        Sin comparativa
                    @endif

                </small>

            </div>



            <div class="detail-stat">

                <span>Evaluaciones</span>

                <strong>
                    {{ $evaluations->count() }}
                </strong>

                <small>
                    Seguimientos registrados
                </small>

            </div>


        </div>



        {{-- GRÁFICAS --}}

        <div class="charts-grid">


            <div class="progress-chart-card">

                <div class="chart-title">

                    <div>
                        <span>EVOLUCIÓN</span>
                        <h4>Peso corporal</h4>
                    </div>

                    <i class="fas fa-weight"></i>

                </div>

                <div class="chart-container">
                    <canvas id="weightChart"></canvas>
                </div>

            </div>



            <div class="progress-chart-card">

                <div class="chart-title">

                    <div>
                        <span>COMPOSICIÓN CORPORAL</span>
                        <h4>Grasa y masa muscular</h4>
                    </div>

                    <i class="fas fa-chart-area"></i>

                </div>

                <div class="chart-container">
                    <canvas id="compositionChart"></canvas>
                </div>

            </div>


        </div>



        {{-- HISTORIAL --}}

        <div class="history-card">


            <div class="chart-title">

                <div>

                    <span>HISTORIAL</span>

                    <h4>
                        Evaluaciones registradas
                    </h4>

                </div>

                <i class="fas fa-clipboard-list"></i>

            </div>


            <div class="table-responsive">

                <table class="table progress-history-table">

                    <thead>

                        <tr>
                            <th>Fecha</th>
                            <th>Peso</th>
                            <th>IMC</th>
                            <th>Grasa</th>
                            <th>Músculo</th>
                            <th>Cintura</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($evaluations->sortByDesc('evaluation_date') as $evaluation)

                            <tr>

                                <td>
                                    {{ $evaluation->evaluation_date->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ $evaluation->weight ?? '—' }}
                                    kg
                                </td>

                                <td>
                                    {{ $evaluation->bmi ?? '—' }}
                                </td>

                                <td>
                                    {{ $evaluation->body_fat ?? '—' }}
                                    %
                                </td>

                                <td>
                                    {{ $evaluation->muscle_mass ?? '—' }}
                                    kg
                                </td>

                                <td>
                                    {{ $evaluation->waist ?? '—' }}
                                    cm
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


    @endif


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
            circle at 14% 10%,
            rgba(65,121,81,.20),
            transparent 30%
        ),
        radial-gradient(
            circle at 90% 50%,
            rgba(100,153,101,.11),
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


/* HEADER */

.progress-detail-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 15px;

}

.progress-eyebrow {

    color: #8eb59a;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 2px;

}

.progress-detail-header h1 {

    margin: 4px 0;

    color: #f3faf4;

    font-size: 30px;

}

.progress-detail-header p {

    margin: 0;

    color: rgba(220,235,223,.45);

    font-size: 12px;

}


/* BOTONES */

.btn-progress-add,
.btn-progress-back {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 10px 14px;

    border-radius: 13px;

    font-size: 10px;

    font-weight: 600;

    text-decoration: none !important;

}

.btn-progress-add {

    background: #a7ca9d;

    color: #102417 !important;

}

.btn-progress-back {

    border: 1px solid rgba(255,255,255,.10);

    background: rgba(255,255,255,.045);

    color: #c9dbcb !important;

}


/* MÉTRICAS */

.detail-stats {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0,1fr));

    gap: 14px;

    margin-bottom: 18px;

}

.detail-stat {

    padding: 18px;

    border-radius: 19px;

    border:
        1px solid rgba(255,255,255,.09);

    background:
        rgba(255,255,255,.04);

    backdrop-filter: blur(20px);

}

.detail-stat span {

    display: block;

    color: rgba(214,230,217,.40);

    font-size: 9px;

}

.detail-stat strong {

    display: block;

    margin: 5px 0;

    color: #f1f8f2;

    font-size: 23px;

}

.detail-stat small {

    color: #9fbd9f;

    font-size: 8px;

}


/* GRÁFICAS */

.charts-grid {

    display: grid;

    grid-template-columns:
        repeat(2,minmax(0,1fr));

    gap: 16px;

}

.progress-chart-card,
.history-card {

    padding: 22px;

    border-radius: 23px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.04);

    backdrop-filter: blur(22px);

}

.chart-title {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 18px;

}

.chart-title span {

    color: rgba(191,214,194,.35);

    font-size: 8px;

    letter-spacing: 1.4px;

}

.chart-title h4 {

    margin: 3px 0 0;

    color: #eff7f0;

    font-size: 16px;

}

.chart-title > i {

    color: #a7c99f;

    font-size: 20px;

}

.chart-container {

    position: relative;

    height: 300px;

}


/* HISTORIAL */

.history-card {

    margin-top: 16px;

}

.progress-history-table {

    color: rgba(225,238,227,.68);

}

.progress-history-table th {

    border: none !important;

    color: rgba(203,222,206,.35);

    font-size: 8px;

}

.progress-history-table td {

    border-top:
        1px solid rgba(255,255,255,.055) !important;

    font-size: 10px;

}


/* VACÍO */

.progress-empty-detail {

    padding: 80px 20px;

    text-align: center;

    border-radius: 24px;

    background:
        rgba(255,255,255,.04);

    color:
        rgba(218,232,220,.45);

}

.progress-empty-detail i {

    margin-bottom: 15px;

    color: #9aba95;

    font-size: 42px;

}

.progress-empty-detail h4 {

    color: #eff7f0;

}

.progress-empty-detail a {

    display: inline-block;

    margin-top: 12px;

    color: #a9cfa2;

}


/* RESPONSIVE */

@media(max-width: 1000px) {

    .detail-stats {

        grid-template-columns: 1fr 1fr;

    }

    .charts-grid {

        grid-template-columns: 1fr;

    }

}

@media(max-width: 650px) {

    .progress-detail-header {

        align-items: flex-start;

        flex-direction: column;

    }

    .detail-stats {

        grid-template-columns: 1fr;

    }

}

</style>

@stop



@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const labels = @json($labels);

    const weights = @json($weights);

    const bodyFat = @json($bodyFat);

    const muscleMass = @json($muscleMass);


    const chartOptions = {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                labels: {
                    color: 'rgba(225,240,228,.65)'
                }

            }

        },

        scales: {

            x: {

                ticks: {
                    color: 'rgba(220,235,223,.40)'
                },

                grid: {
                    color: 'rgba(255,255,255,.04)'
                }

            },

            y: {

                ticks: {
                    color: 'rgba(220,235,223,.40)'
                },

                grid: {
                    color: 'rgba(255,255,255,.05)'
                }

            }

        }

    };


    /* PESO */

    new Chart(
        document.getElementById('weightChart'),
        {

            type: 'line',

            data: {

                labels: labels,

                datasets: [

                    {

                        label: 'Peso (kg)',

                        data: weights,

                        borderColor: '#a7ca9d',

                        backgroundColor:
                            'rgba(167,202,157,.12)',

                        fill: true,

                        tension: .35

                    }

                ]

            },

            options: chartOptions

        }
    );


    /* COMPOSICIÓN */

    new Chart(
        document.getElementById('compositionChart'),
        {

            type: 'line',

            data: {

                labels: labels,

                datasets: [

                    {

                        label: 'Grasa (%)',

                        data: bodyFat,

                        borderColor: '#d7bd70',

                        tension: .35

                    },

                    {

                        label: 'Masa muscular (kg)',

                        data: muscleMass,

                        borderColor: '#87beb0',

                        tension: .35

                    }

                ]

            },

            options: chartOptions

        }
    );

});

</script>

@stop