@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Responsable Compras
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($responsableCompras, ['route' => ['responsableCompras.update', $responsableCompras->id], 'method' => 'patch']) !!}

                        @include('responsable_compras.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection