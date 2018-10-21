@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Hierro
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($hierro, ['route' => ['hierros.update', $hierro->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group col-sm-6">
                            <img width="120px" src="{{ Storage::url($hierro->hierro) }}">
                        </div>
                        @include('hierros.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection