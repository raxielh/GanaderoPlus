@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Lugar Procedencia
        </h4>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('lugar_procedencias.show_fields')
                    <a href="{!! route('lugarProcedencias.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
