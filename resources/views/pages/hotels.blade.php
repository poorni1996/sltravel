@extends('welcome')
@section('style')
<link rel="stylesheet" href="css/hotels.css" />
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="topPannel">
    <div class="container">
        <section class="hotel">
            <div class="caption h3">
                Bookings
            </div>

            <h5 class="h5">
                Experience the best of the best hotels in Sri Lanka
            </h5>


            <form method="GET">
                {{-- <input type="hidden" name="lat" id="lat" value="">
                <input type="hidden" name="lng" id="lng" value=""> --}}
                <div class="row filterBox">
                    <div class="col-md-3 mb-3">
                        <label>Looking for ...</label>
                        <input class="form-control" type="text" name="q" value="{{ $filters->q }}">
                        @error('q')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>City</label>
                        <select class="form-control select2bs4" id="city" name="city">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $filters['city'] == $city->id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        @error('city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Activity</label>
                        <input class="form-control" type="text" name="activity" value="{{ $filters->activity }}">
                        @error('activity')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Menu</label>
                        <input class="form-control" type="text" name="menu" value="{{ $filters->menu }}">
                        @error('menu')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" id="date"
                            value="{{ today()->format('Y-m-d') }}">
                        @error('date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Price From</label>
                        <input class="form-control" type="text" name="price_from">
                        @error('price_from')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Price To</label>
                        <input class="form-control" type="text" name="price_to">
                        @error('price_to')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <label class="d-block">&nbsp;</label>
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>


<div class="container">
    <section class="hotel">
        <div class="row">
            @foreach ($hotels as $hotel)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <img src="{{Storage::url($hotel->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="{{route('hotel', ['id' => $hotel->id, 'from' => isset($hotel->distance) ? $filters['city'] : null])}}">
                            <h5 class="card-title text-left">
                                {{ $hotel->name }}
                                <br />
                                <span class="location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{ $hotel->city_name }} 
                                    @isset($hotel->distance)
                                        ({{number_format($hotel->distance, 2)}}km)
                                    @endisset
                                </span>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

@endsection

@section('script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        if (navigator.geolocation && $('#city').val() == "") {
            navigator.geolocation.getCurrentPosition((position) => {
                let lat = position.coords.latitude;
                let long = position.coords.longitude;
                // $("#lat").val(lat);
                // $("#lng").val(long);
                // console.log(lat, long);
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('city.closest_show') }}",
                    data: {_token: "{{csrf_token()}}", lat:lat, lng:long},
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        $('#city').val(response.id);
                        $('#city').change();
                    }
                });
            });
        }
    });
</script>
@endsection