@extends('adminlte::page')

@section('title', 'Pagos | NutriAdmin')


@section('content_header')

<div class="payments-header">

    <div>

        <span class="payments-eyebrow">

            <i class="fas fa-leaf mr-1"></i>
            NUTRIADMIN

        </span>

        <h1>Pagos</h1>

        <p>
            Controla los ingresos y pagos de tus pacientes.
        </p>

    </div>


    <a href="{{ route('pagos.create') }}"
       class="btn-payment-primary">

        <i class="fas fa-plus"></i>

        Registrar pago

    </a>

</div>

@stop



@section('content')


<div class="payments-page">


    @if(session('success'))

        <div class="payment-alert">

            <i class="fas fa-check-circle"></i>

            {{ session('success') }}

        </div>

    @endif



    {{-- MÉTRICAS --}}

    <div class="payment-stats">


        <div class="payment-stat">

            <div class="stat-payment-icon">

                <i class="fas fa-wallet"></i>

            </div>

            <div>

                <span>Ingresos del mes</span>

                <h3>
                    ${{ number_format($monthIncome, 2) }}
                </h3>

            </div>

        </div>



        <div class="payment-stat">

            <div class="stat-payment-icon green">

                <i class="fas fa-check"></i>

            </div>

            <div>

                <span>Pagos recibidos</span>

                <h3>
                    {{ $paidPayments }}
                </h3>

            </div>

        </div>



        <div class="payment-stat">

            <div class="stat-payment-icon yellow">

                <i class="far fa-clock"></i>

            </div>

            <div>

                <span>Pendientes</span>

                <h3>
                    {{ $pendingPayments }}
                </h3>

            </div>

        </div>



        <div class="payment-stat">

            <div class="stat-payment-icon">

                <i class="fas fa-coins"></i>

            </div>

            <div>

                <span>Ingreso histórico</span>

                <h3>
                    ${{ number_format($totalIncome, 2) }}
                </h3>

            </div>

        </div>


    </div>



    {{-- LISTADO --}}

    <div class="payments-card">


        <div class="payments-card-header">

            <div>

                <span>HISTORIAL</span>

                <h4>Movimientos recientes</h4>

            </div>


            <i class="fas fa-receipt"></i>

        </div>



        @if($payments->isEmpty())


            <div class="empty-payments">

                <i class="fas fa-wallet"></i>

                <h5>
                    Sin pagos registrados
                </h5>

                <p>
                    Los pagos de tus pacientes aparecerán aquí.
                </p>

                <a href="{{ route('pagos.create') }}">
                    Registrar primer pago
                </a>

            </div>


        @else


            <div class="table-responsive">

                <table class="table payment-table">

                    <thead>

                        <tr>

                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>Concepto</th>
                            <th>Método</th>
                            <th>Estado</th>
                            <th class="text-right">Monto</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($payments as $payment)

                            <tr>

                                <td>

                                    {{ $payment->paid_at->format('d/m/Y') }}

                                </td>


                                <td>

                                    <strong>

                                        {{ $payment->patient->first_name }}
                                        {{ $payment->patient->last_name }}

                                    </strong>

                                </td>


                                <td>

                                    {{ $payment->concept }}

                                </td>


                                <td>

                                    {{ $payment->payment_method }}

                                </td>


                                <td>

                                    @if($payment->status === 'Pagado')

                                        <span class="payment-status paid">
                                            Pagado
                                        </span>

                                    @elseif($payment->status === 'Pendiente')

                                        <span class="payment-status pending">
                                            Pendiente
                                        </span>

                                    @else

                                        <span class="payment-status cancelled">
                                            Cancelado
                                        </span>

                                    @endif

                                </td>


                                <td class="text-right payment-amount">

                                    ${{ number_format($payment->amount, 2) }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


        @endif


    </div>


</div>

@stop



@section('css')

<link rel="stylesheet"
      href="{{ asset('css/nutriadmin.css') }}">

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>


<style>

body {

    background:
        radial-gradient(
            circle at 15% 10%,
            rgba(75,120,84,.20),
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


.payments-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;
}


.payments-eyebrow {

    color: #8eb59a;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 2px;
}


.payments-header h1 {

    margin: 4px 0;

    color: #f3faf4;

    font-size: 32px;
}


.payments-header p {

    margin: 0;

    color: rgba(220,235,223,.48);

    font-size: 13px;
}


.btn-payment-primary {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 11px 18px;

    border-radius: 14px;

    background:
        linear-gradient(
            135deg,
            #b5d6a5,
            #7fab7d
        );

    color: #102417 !important;

    font-size: 12px;

    font-weight: 700;

    text-decoration: none !important;
}


.payment-alert {

    margin-bottom: 18px;

    padding: 13px 16px;

    border-radius: 14px;

    background: rgba(92,165,103,.13);

    border:
        1px solid rgba(120,195,131,.20);

    color: #bce1c1;
}


.payment-stats {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 14px;

    margin-bottom: 18px;
}


.payment-stat {

    display: flex;

    align-items: center;

    gap: 13px;

    padding: 18px;

    border-radius: 20px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.045);

    backdrop-filter: blur(18px);
}


.stat-payment-icon {

    width: 46px;

    height: 46px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    background:
        rgba(189,167,93,.10);

    color: #dbc879;
}


.stat-payment-icon.green {

    color: #92d39b;
}


.stat-payment-icon.yellow {

    color: #ddbd66;
}


.payment-stat span {

    color: rgba(219,235,221,.42);

    font-size: 9px;
}


.payment-stat h3 {

    margin: 3px 0 0;

    color: white;

    font-size: 22px;

    font-weight: 600;
}


.payments-card {

    padding: 24px;

    border-radius: 24px;

    border:
        1px solid rgba(255,255,255,.10);

    background:
        rgba(255,255,255,.045);

    backdrop-filter: blur(22px);
}


.payments-card-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding-bottom: 18px;

    margin-bottom: 10px;

    border-bottom:
        1px solid rgba(255,255,255,.06);
}


.payments-card-header span {

    color: rgba(194,215,197,.35);

    font-size: 8px;

    letter-spacing: 1.5px;
}


.payments-card-header h4 {

    margin: 4px 0 0;

    color: #eff7f0;

    font-size: 18px;
}


.payments-card-header > i {

    color: #cdbb75;

    font-size: 22px;
}


/* =========================================================
   TABLA DE PAGOS - GLASS
========================================================= */

.table-responsive {
    overflow-x: auto;
    border-radius: 16px;
}


/* TABLA */

.payment-table {
    width: 100%;

    margin: 0;

    border-collapse: separate !important;
    border-spacing: 0 8px;

    background: transparent !important;

    color: rgba(229,240,231,.72);
}


/* QUITAR FONDOS DE ADMINLTE */

.payment-table,
.payment-table thead,
.payment-table tbody,
.payment-table tr,
.payment-table th,
.payment-table td {

    background-color: transparent !important;
}


/* ENCABEZADOS */

.payment-table thead th {

    padding: 5px 14px 9px;

    border: none !important;

    color: rgba(193,216,197,.40);

    font-size: 8px;

    font-weight: 700;

    letter-spacing: .8px;

    text-transform: uppercase;
}


/* FILAS */

.payment-table tbody tr {

    transition: .2s ease;
}


/* CELDAS */

.payment-table tbody td {

    padding: 14px;

    vertical-align: middle;

    border-top:
        1px solid rgba(255,255,255,.075) !important;

    border-bottom:
        1px solid rgba(255,255,255,.045) !important;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.055),
            rgba(255,255,255,.022)
        ) !important;

    color: rgba(225,238,228,.67);

    font-size: 10px;
}


/* BORDE IZQUIERDO */

.payment-table tbody td:first-child {

    border-left:
        1px solid rgba(255,255,255,.07) !important;

    border-radius:
        13px 0 0 13px;
}


/* BORDE DERECHO */

.payment-table tbody td:last-child {

    border-right:
        1px solid rgba(255,255,255,.07) !important;

    border-radius:
        0 13px 13px 0;
}


/* HOVER DE LA FILA */

.payment-table tbody tr:hover td {

    background:
        linear-gradient(
            135deg,
            rgba(145,187,139,.11),
            rgba(255,255,255,.035)
        ) !important;

    border-color:
        rgba(157,199,151,.15) !important;
}


/* FECHA */

.payment-table tbody td:first-child {

    color: #a7c6a1;

    font-weight: 600;
}


/* PACIENTE */

.payment-table strong {

    color: #eef7ef;

    font-weight: 600;
}


/* MONTO */

.payment-amount {

    color: #c3deb9 !important;

    font-size: 11px !important;

    font-weight: 700;

    letter-spacing: .2px;
}

.payment-status {

    display: inline-block;

    padding: 4px 9px;

    border-radius: 12px;

    font-size: 8px;
}


.payment-status.paid {

    background:
        rgba(82,167,96,.12);

    color: #9cd2a5;
}


.payment-status.pending {

    background:
        rgba(205,171,80,.10);

    color: #dec273;
}


.payment-status.cancelled {

    background:
        rgba(195,83,83,.10);

    color: #db9191;
}


.empty-payments {

    padding: 60px 20px;

    text-align: center;

    color: rgba(219,235,221,.45);
}


.empty-payments > i {

    margin-bottom: 15px;

    color: #b6cfae;

    font-size: 38px;
}


.empty-payments h5 {

    color: #eef6ef;
}


.empty-payments a {

    display: inline-block;

    margin-top: 12px;

    color: #acd2a4;
}


@media(max-width: 1000px) {

    .payment-stats {

        grid-template-columns: 1fr 1fr;

    }

}


@media(max-width: 600px) {

    .payments-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .payment-stats {

        grid-template-columns: 1fr;

    }

}

</style>

@stop