@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Tipo Ganado
        </h4>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('tipo_ganados.show_fields')
                    <a href="{!! route('tipoGanados.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
