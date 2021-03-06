@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Control LLuvias
        </h4>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'controlLLuvias.store']) !!}

                        @include('control_l_luvias.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
