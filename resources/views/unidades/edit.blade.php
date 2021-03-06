@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Unidades
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($unidades, ['route' => ['unidades.update', $unidades->id], 'method' => 'patch']) !!}

                        @include('unidades.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection