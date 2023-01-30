@extends('welcome')
@section('style')
<link rel="stylesheet" href="{{asset('css/hotel.css')}}" />
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        /* position: absolute; */
        /* top: -9999px; */
        display: none;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    span.fa.fa-star.checked {
        color: #ffc700;
    }

    /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>
@endsection

@section('content')

<div class="container">
    <section class="hotel">
        <div class="row">
            <div class="col-md-6">
                <div class="caption hidelg">
                    {{$hotel->name}}
                </div>
                <div id="main_slider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $key => $image)
                        <div class="carousel-item {{($key == '0' ? 'active' : '')}}">
                            <img class="img-fluid w-100" src="{{Storage::url($image->image)}}" alt="hotelImage">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#main_slider"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#main_slider"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="caption showlg">
                    {{$hotel->name}}

                </div>
                <div class="text-justify description">
                    {{$hotel->description}}
                </div>
                @if (!auth()->check() || auth()->user()->user_role == 'CUS')
                <div class="row">
                    <div class="col">
                        <button class="btn btn-outline-success bookingBtn" data-bs-toggle="modal"
                            data-bs-target="#book_hotel">
                            <i class="fa-solid fa-hotel"></i>
                            Book Now
                        </button>
                        @if (empty($wishlist))
                        <form action="{{ route('hotel_wishlist.store') }}" class="d-inline" method="POST">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <button type="submit" class="btn btn-outline-danger bookingBtn" title="Add to Wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('hotel_wishlist.destroy') }}" class="d-inline" method="POST">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <button type="submit" class="btn btn-danger bookingBtn" title="Remove from Wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="caption h3">
                Features
            </div>
            <hr style="margin-bottom: 15px" />
            @foreach ($features as $feature)
            <div class="col-md mb-2 ficon">
                <i class="{{ $feature->icon }}"></i>
                <div>{{ $feature->desc }}</div>
            </div>
            @endforeach
        </div>


        <div class="row" style="margin-top: 15px">
            <div class="caption h3">
                Location
            </div>
            <hr style="margin-bottom: 15px" />
            <div class="col-md-6">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="100%" id="gmap_canvas"
                            src="https://maps.google.com/maps?q={{$hotel->latitude}},{{$hotel->longitude}}&hl=es;z=14&amp;output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="location">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa-solid fa-map-marker-alt"></i>
                                <span>
                                    Address
                                </span>
                                <p>
                                    {{ $hotel->address }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa-solid fa-phone"></i>
                                <span>
                                    Phone
                                </span>
                                @foreach ($telephones as $tp)
                                <p>
                                    {{ $tp->telephone }}
                                </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($hotel->distance))
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa-solid fa-clock"></i>
                                <span>
                                    Average Distance & Time
                                </span>
                                <p>
                                    {{ number_format($hotel->distance, 2) }}km -
                                    {{ number_format($hotel->distance / 26, 2) }} Hours
                                </p>
                            </div>
                        </div>
                        @endif

                        <div class="col-12 col-md-6">
                            <i class="fa-solid fa-user"></i>
                            <span>
                                Reviews
                            </span>
                            <div>
                                @for ($i = 1; $i < 6; $i++) <span
                                    class="fa fa-star {{ $i < $total_rate ? 'checked' : '' }}"></span>
                                    @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($activities->isNotEmpty())
        <div class="row" style="margin-top: 15px">
            <div class="caption h3">
                Activities
            </div>
            <hr style="margin-bottom: 15px" />
            @foreach ($activities as $activity)
            <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="{{Storage::url($activity->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $activity->title }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if ($menu->isNotEmpty())
        <div class="row" style="margin-top: 15px">
            <div class="caption h3">
                Menu
            </div>
            <hr style="margin-bottom: 15px" />
            @foreach ($menu as $menu_itm)
            <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="{{Storage::url($menu_itm->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $menu_itm->name }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <div class="row" style="margin-top: 15px">
            <div class="caption h3">
                Reviews
            </div>
            <hr style="margin-bottom: 15px" />

            @if ($can_review)
            <form action="{{ route('hotel_review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <div class="col-12">
                    <div class="form-group">
                        <label for="review">Add Review</label>
                        <div class="row">
                            <div class="col">

                                <div class="rate d-block">
                                    <input type="radio" id="star5" name="rate" value="5" checked />
                                    <label for="star5">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1">1 star</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea id="review" class="form-control" name="review" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-3">
                                <button class="btn btn-primary float-end" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
            <div class="col-12 my-3">
                @forelse ($reviews as $review)
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-grow-1 bd-highlight">
                                <h5 class="card-title">{{ $review->fname . ' ' . $review->lname }}</h5>
                                <p class="card-text">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            {{-- <span><b>{{$review->ratings}}</b></span> --}}
                                            @for ($i = 0; $i < 5; $i++) <span
                                                class="fa fa-star {{ $i < $review->ratings ? 'checked' : '' }}"></span>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                {{ $review->review }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>No reviews yet</p>
                @endforelse
            </div>
        </div>
        <div class="row" style="margin-top:20px">

            <button class="btn btn-outline-primary bookingBtn" data-bs-toggle="modal" data-bs-target="#book_hotel">
                <i class="fa-solid fa-hotel"></i>
                Book Now
            </button>

        </div>
    </section>
</div>

<div class="modal fade" id="book_hotel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="book_hotelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="book_hotelLabel">
                    Book Me
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @guest
                Please <a href="{{ route('login') }}">Login</a> to Book this Hotel
                @else
                <form action="{{ route('hotel_booking.store') }}" method="POST" class="row g-3">
                    @csrf
                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                    <div class="col-md-6">
                        <label for="name">Your Name <span class="req">*</span></label>
                        <input type="text" name="name" id="name"
                            value="{{ old('name', auth()->user()->fname . ' ' . auth()->user()->lname) }}"
                            class="form-control">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="contact_no">Contact No <span class="req">*</span></label>
                        <input type="text" name="contact_no" id="contact_no" class="form-control"
                            value="{{old('contact_no')}}">
                        @error('contact_no')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email">E-mail <span class="req">*</span></label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{old('email', auth()->user()->email)}}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="date">Date <span class="req">*</span></label>
                        <input type="date" class="form-control" name="date" id="date"
                            value="{{ old('date', today()->addDays(1)->format('Y-m-d')) }}">
                        @error('date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" value="{{old('adults', 2)}}"
                                name="adults">
                            <span class="input-group-text" id="basic-addon2">Adults</span>
                        </div>
                        @error('adults')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <input type="number" min="0" class="form-control" value="{{old('children', 0)}}"
                                name="children">
                            <span class="input-group-text" id="basic-addon2">Children</span>
                        </div>
                        @error('children')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 mb-2">
                        <i><small class="float-end">NOTE: You need to pay an advanced fee to complete this booking</small></i>
                    </div>
                    <div class="col-12 mb-2">
                        <button class="btn btn-outline-success float-end" type="submit">
                            <i class="fa-solid fa-hotel"></i>
                            Book Hotel
                        </button>
                    </div>
                </form>
                @endguest
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
@if (!$errors->isEmpty())
<script type="text/javascript">
    $(document).ready(function () {
        $("#book_hotel").modal('show')
    });
</script>
@endif
@endsection