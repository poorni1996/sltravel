@extends('welcome')
@section('style')
<link rel="stylesheet" href="{{asset('css/helamenu.css')}}" />
@endsection

@section('content')
<div class="container activity">
    <h3 class="h3 des">Hela Menu</h3>
    <h6 class="h6">
        Taste the Mouth watering best foods in Sri Lanka.
    </h6>
    <hr />

    <div class="row">
        @foreach ($menu as $menu_itm)
        <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
            <a class="text-decoration-none text-dark"
                href="{{ route('public_hotels', ['menu' => $menu_itm->name]) }}">
                <div class="card">
                    <img src="{{Storage::url($menu_itm->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $menu_itm->name }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>


</div>
@endsection