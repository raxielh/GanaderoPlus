@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Lugar Procedencia
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lugarProcedencia, ['route' => ['lugarProcedencias.update', $lugarProcedencia->id], 'method' => 'patch']) !!}

                        @include('lugar_procedencias.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection