@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Registro Compra
        </h4>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'registroCompras.store']) !!}

                        @include('registro_compras.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="lp" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Lugar de procedencia</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'lugarProcedencias.store']) !!}
                @include('lugar_procedencias.rc_fields')
            {!! Form::close() !!}
        </div>
        <div class="modal-footer"></div>
      </div>    
    </div>
</div>





@endsection
