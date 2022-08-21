@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">More information of the autoshop {{$autoshop->name}} {{$autoshop->surname}} </div>
                <div class="card-body">
                    <b>Name:</b> {{$autoshop->name}}<br>
                    <b>Address:</b> {{$autoshop->address}}<br>
                    <b>Phone number:</b> {{$autoshop->phone_nr}}<br><br>
                    <b>Mechanics:</b><br>
                        @foreach ($mechanics as $mechanic)

                            @if ($mechanic->mechanicAutoshop->id === $autoshop->id)
                            {{$mechanic->name}} {{$mechanic->surname}}<br>
                            @if($mechanic->photo)
                            <div class="image-box">
                                <img src="{{$mechanic->photo}}">
                                @endif
                            </div>
                            @endif
                        @endforeach
                    <br><b>Services:</b><br>
                    @foreach ($mechanics as $mechanic)
                    @foreach ($services as $service)
                    @if ($mechanic->mechanicAutoshop->id === $autoshop->id && $service->serviceMechanic->id === $mechanic->id)
                    {{$service->name}}<br>
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
