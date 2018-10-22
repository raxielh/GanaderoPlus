@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Ingreso de Animales
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($ingresoAnimal, ['route' => ['ingresoAnimals.update', $ingresoAnimal->id], 'method' => 'patch']) !!}

                        @include('ingreso_animals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection