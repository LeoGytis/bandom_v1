@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Edit {{$country->name}} information</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('country.update',$country)}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="country_name" value="{{$country->name}}"><br>
                            Time: <input type="text" name="country_s_time" value="{{$country->s_time}}"><br>
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
