@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Deduccion
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deduccion, ['route' => ['deduccions.update', $deduccion->id], 'method' => 'patch']) !!}

                        @include('deduccions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection