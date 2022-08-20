@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$hotel->name}}</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="post" action="{{route('hotel.update',$hotel)}}" enctype="multipart/form-data">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input class="ms-3 mt-3" type="text" name="hotel_name" value="{{$hotel->name}}"><br>
                            Price: <input class="ms-3 mt-3" type="text" name="hotel_price" value="{{$hotel->price}}"><br>
                            Trip time: <input class="ms-3 mt-3" type="text" name="hotel_trip_time" value="{{$hotel->trip_time}}"><br>
                            <select class="mt-3" name="country_id">
                                @foreach ($countries as $country)
                                <option value="{{$country->id}}" @if($country->id == $hotel->country_id) selected @endif>
                                    {{$country->name}}
                                </option>
                                @endforeach
                            </select>
                            @if($hotel->photo)
                            <div class="image-box mt-3 me-3">
                                <img src="{{$hotel->photo}}">
                            </div>
                            @endif
                            <div class="form-group mt-2">
                                <label>Photo of the Hotel</label>
                                <input class="form-control" type="file" name="hotel_photo" />
                            </div>
                        </div>
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-success mt-3 mb-3" type="submit">Save</button>
                    </form>
                    @if($hotel->photo)
                    <form class="d-flex flex-column align-items-center" action="{{route('hotels.delete-picture', $hotel)}}" method="post">
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-danger mt-4" type="submit">Delete picture</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
