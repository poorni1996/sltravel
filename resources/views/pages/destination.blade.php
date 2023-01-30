@extends('welcome')
@section('style')
<link rel="stylesheet" href="{{asset('css/destination.css')}}" />
@endsection

@section('content')
<div class="container desti">
    <h3 class="h3 des">Destinations</h3>
    <h6 class="h6">Discover the best destinations in Sri Lanka With SL Travel</h6>
    <hr />

    @foreach ($dests as $dest)

    <div class="row">
        <div class="col-lg-3 col-md-5 col-sm-12 mb-5 text-left">
            <img class="img-fluid despic " src="{{Storage::url($dest->gallery_image)}}" alt="destinationPic">
        </div>
        <div class="col-lg-9 col-md-5 col-sm-12 mb-5">
            <h3 class="h3 topic">{{ $dest->name }}</h3>
            <p class="text-mute">
                {{$dest->description}}
            </p>
            <button class="btn  btn-outline-info">
                <a href="{{ route('public_hotels', ['destination' => $dest->city_id]) }}">View Hotels</a>
            </button>
        </div>
    </div>
    @endforeach


</div>
@endsection