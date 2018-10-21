@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Estado Protrero
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estadoProtrero, ['route' => ['estadoProtreros.update', $estadoProtrero->id], 'method' => 'patch']) !!}

                        @include('estado_protreros.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection