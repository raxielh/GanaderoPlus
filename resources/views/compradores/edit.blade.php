@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Compradores
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($compradores, ['route' => ['compradores.update', $compradores->id], 'method' => 'patch']) !!}

                        @include('compradores.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection