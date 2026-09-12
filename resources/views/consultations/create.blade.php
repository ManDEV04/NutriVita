@extends('adminlte::page')

@section('title', 'Nueva consulta | NutriAdmin')


@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <div>

        <h1 class="mb-1">
            Nueva consulta
        </h1>

        <p class="text-muted mb-0">
            Registra la atención y recomendaciones del paciente.
        </p>

    </div>


    <a
        href="{{ route('consultas.index') }}"
        class="btn btn-light"
    >

        <i class="fas fa-arrow-left mr-1"></i>

        Regresar

    </a>

</div>

@stop



@section('content')


<form
    method="POST"
    action="{{ route('consultas.store') }}"
>

    @csrf


    <div class="card">

        <div class="card-body p-4">


            <div class="row">


                {{-- PACIENTE --}}

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Paciente *
                        </label>

                        <select
                            name="patient_id"
                            class="form-control"
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

                    </div>

                </div>



                {{-- FECHA --}}

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Fecha y hora *
                        </label>

                        <input
                            type="datetime-local"
                            name="consultation_at"
                            value="{{ old('consultation_at', now()->format('Y-m-d\TH:i')) }}"
                            class="form-control"
                            required
                        >

                    </div>

                </div>



                {{-- CITA --}}

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Cita relacionada
                        </label>

                        <select
                            name="appointment_id"
                            class="form-control"
                        >

                            <option value="">
                                Ninguna
                            </option>

                            @foreach($appointments as $appointment)

                                <option
                                    value="{{ $appointment->id }}"
                                    {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}
                                >

                                    {{ $appointment->patient->first_name }}
                                    {{ $appointment->patient->last_name }}

                                    —

                                    {{ $appointment->appointment_at->format('d/m/Y H:i') }}

                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">

                            Opcional. Si seleccionas una cita,
                            se marcará como completada.

                        </small>

                    </div>

                </div>



                {{-- MOTIVO --}}

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Motivo
                        </label>

                        <input
                            type="text"
                            name="reason"
                            value="{{ old('reason') }}"
                            class="form-control"
                            placeholder="Ej. Seguimiento mensual"
                        >

                    </div>

                </div>



                {{-- OBSERVACIONES --}}

                <div class="col-md-12">

                    <div class="form-group">

                        <label>
                            Observaciones
                        </label>

                        <textarea
                            name="observations"
                            rows="5"
                            class="form-control"
                            placeholder="Describe cómo se encuentra el paciente, adherencia, síntomas, cambios..."
                        >{{ old('observations') }}</textarea>

                    </div>

                </div>



                {{-- RECOMENDACIONES --}}

                <div class="col-md-12">

                    <div class="form-group">

                        <label>
                            Recomendaciones
                        </label>

                        <textarea
                            name="recommendations"
                            rows="5"
                            class="form-control"
                            placeholder="Indicaciones para el paciente..."
                        >{{ old('recommendations') }}</textarea>

                    </div>

                </div>



                {{-- PRÓXIMA CONSULTA --}}

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            Próxima consulta
                        </label>

                        <input
                            type="date"
                            name="next_visit"
                            value="{{ old('next_visit') }}"
                            class="form-control"
                        >

                    </div>

                </div>


            </div>

        </div>



        <div class="card-footer text-right">

            <a
                href="{{ route('consultas.index') }}"
                class="btn btn-light"
            >
                Cancelar
            </a>


            <button
                type="submit"
                class="btn btn-success ml-2"
            >

                <i class="fas fa-save mr-1"></i>

                Guardar consulta

            </button>

        </div>

    </div>


</form>

@stop


@section('css')

<link
    rel="stylesheet"
    href="{{ asset('css/nutriadmin.css') }}"
>

@stop