@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Pregunta Facturas
        </h4>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'preguntaFacturas.store']) !!}

                        @include('pregunta_facturas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
