@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Dosificaciones
        </h4>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'dosificaciones.store']) !!}

                        @include('dosificaciones.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
