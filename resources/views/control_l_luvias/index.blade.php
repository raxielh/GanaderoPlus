@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4 class="pull-left">Control LLuvias</h4>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('controlLLuvias.create') !!}"><i class="mdi mdi-plus"></i> Agregar nuevo</a>
           <a class="btn btn-info pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 10px;" href="{!! route('controlLLuvias.resumen') !!}"><i class="mdi mdi-chart-bar"></i> Resumen</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('control_l_luvias.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection
