@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Presentacion
        </h4>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('presentacions.show_fields')
                    <a href="{!! route('presentacions.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
