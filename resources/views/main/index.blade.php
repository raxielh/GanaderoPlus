@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Ubicación</h3>
                </div>
                <div class="box-body">
                    @foreach ($F as $F)
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $F->lat}},{{ $F->lon}}&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:F%7C{{ $F->lat}},{{ $F->lon}}&key=AIzaSyBcuL57fE7kGODVpu6TsoFRFR2kaIr5LWw" width="100%" alt="">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection