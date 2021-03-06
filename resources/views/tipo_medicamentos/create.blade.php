@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Tipo Medicamentos
        </h4>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'tipoMedicamentos.store']) !!}

                        @include('tipo_medicamentos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
