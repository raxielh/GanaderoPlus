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
                    {!! Form::open(['route' => 'deduccions.store']) !!}

                        @include('deduccions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
