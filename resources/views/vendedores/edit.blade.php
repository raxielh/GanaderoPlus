@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Vendedores
        </h4>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($vendedores, ['route' => ['vendedores.update', $vendedores->id], 'method' => 'patch']) !!}

                        @include('vendedores.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection