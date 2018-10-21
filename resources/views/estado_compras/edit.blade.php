@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Estado Compra
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estadoCompra, ['route' => ['estadoCompras.update', $estadoCompra->id], 'method' => 'patch']) !!}

                        @include('estado_compras.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection