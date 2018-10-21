@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Tipo Ganado
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoGanado, ['route' => ['tipoGanados.update', $tipoGanado->id], 'method' => 'patch']) !!}

                        @include('tipo_ganados.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection