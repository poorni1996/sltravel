@extends('welcome')
@section('style')
<link rel="stylesheet" href="css/activity.css" />
@endsection

@section('content')
<div class="container activity">
    <h3 class="h3 des">Actitvities</h3>
    <h6 class="h6">
        Things you can do in Sri Lanka
    </h6>
    <hr />

    <div class="row">
        @foreach ($activities as $activity)
        <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
            <a class="text-decoration-none text-dark" href="{{ route('public_hotels', ['activity' => $activity->title]) }}">
                <div class="card">
                    <img src="{{ Storage::url($activity->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $activity->title }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>


</div>
@endsection