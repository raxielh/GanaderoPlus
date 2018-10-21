@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Medicamentos
        </h4>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('medicamentos.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
