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
                   {!! Form::model($registroCompra, ['route' => ['registroCompras.update', $registroCompra->id], 'method' => 'patch']) !!}

                        @include('registro_compras.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection