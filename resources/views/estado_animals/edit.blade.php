@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Estado Animal
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estadoAnimal, ['route' => ['estadoAnimals.update', $estadoAnimal->id], 'method' => 'patch']) !!}

                        @include('estado_animals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection