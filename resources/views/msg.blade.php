<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if ($errors->any())
            <div class="alert">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger msg-container">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if(session()->has('pop_message'))
            <div class="alert alert-success msg-container" role="alert">
                {{session()->get('pop_message')}}
            </div>
            @endif
        </div>
    </div>
</div>
