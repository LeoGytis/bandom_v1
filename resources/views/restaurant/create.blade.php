@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Create new Restaurant</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('restaurant.store')}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="restaurant_name">
                            City: <input type="text" name="restaurant_city">
                            Address: <input type="text" name="restaurant_address">
                            Time: <input type="text" name="restaurant_work_time">
                        </div>
                        @csrf
                        <button class="btn btn-outline-success mt-3" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection