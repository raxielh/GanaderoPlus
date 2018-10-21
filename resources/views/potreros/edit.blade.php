@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Potreros
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($potreros, ['route' => ['potreros.update', $potreros->id], 'method' => 'patch']) !!}

                        @include('potreros.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection