@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            <a href="{!! route('ingresoAnimals.index') !!}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>  Atras</a> Ingreso de Animales
        </h4>
    </section>
    <div class="content">
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('ingreso_animals.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
