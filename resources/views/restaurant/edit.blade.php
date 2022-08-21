@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Edit {{$restaurant->name}} information</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('restaurant.update', $restaurant)}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="restaurant_name" value="{{$restaurant->name}}"><br>
                            City: <input type="text" name="restaurant_city" value="{{$restaurant->city}}"><br>
                            Address: <input type="text" name="restaurant_address" value="{{$restaurant->address}}"><br>
                            Work Time: <input type="text" name="restaurant_work_time" value="{{$restaurant->work_time}}"><br>
                        </div>
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-success mt-3 mb-3" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
