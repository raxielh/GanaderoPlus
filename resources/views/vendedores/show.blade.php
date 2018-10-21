@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Vendedores
        </h4>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('vendedores.show_fields')
                    <a href="{!! route('vendedores.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
