@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Find new Country</div>
                <div class="card-body">
                    <form class="d-flex flex-column align-items-center" method="POST" action="{{route('country.store')}}">
                        <div class="col-md-4 ms-3 mb-3">
                            Name: <input type="text" name="country_name">
                            Time: <input type="text" name="country_s_time">
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
