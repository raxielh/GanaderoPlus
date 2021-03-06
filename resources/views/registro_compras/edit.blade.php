@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Registro Compra
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($registroCompra, ['route' => ['registroCompras.update', $registroCompra->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}

                   <input type="hidden" value="{{$registroCompra->numero_compra}}" id="numero_compra" name="numero_compra">

                        @include('registro_compras.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection