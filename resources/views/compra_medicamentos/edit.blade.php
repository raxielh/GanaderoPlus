@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Compra Medicamento
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($compraMedicamento, ['route' => ['compraMedicamentos.update', $compraMedicamento->id], 'method' => 'patch']) !!}

                        @include('compra_medicamentos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection