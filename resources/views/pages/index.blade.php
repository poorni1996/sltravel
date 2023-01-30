@extends('welcome')
@section('style')
    <link rel="stylesheet" href="css/index.css" />
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="topPannel">
        <div class="container">
            <section class="hotel">
                
                <h5 class="h5">
                    Experience the best of the best hotels in Sri Lanka
                </h5>
            
                <div class="caption">
                    SL Travel
                </div>
                <form method="GET" action="{{ route('public_hotels') }}">
                    <div class="row filterBox">
                        <div class="col-md-3 mb-3">
                            <label>Looking for ...</label>
                            <input class="form-control" type="text" name="q">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>City</label>
                            <select class="form-control select2bs4" id="city" name="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Activity</label>
                            <input class="form-control" type="text" name="activity">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Menu</label>
                            <input class="form-control" type="text" name="menu">
                        </div>
                        <div class="col-md-3">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" id="date"
                                value="{{ today()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Price From</label>
                            <input class="form-control" type="text" name="price_from">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Price To</label>
                            <input class="form-control" type="text" name="price_to">
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

    <div class="container middleC">
        <div class="row">
            <div class="col-lg-6">
                <div class="h3">
                    Life is Jounrey
                </div>
                <p class="text-justify">
                    Life is Journey.Traveling promotes new memories, makes us learn new things, discover different country, gives us the opportunity to learn different language, make new friends, helps us work on our inner peace, and sometimes it makes us a new person. And the most important thing, it’s helped us build the diverse society we live in today.
                </p>
            </div>
      
            <div class="col-lg-6 text-center">
               <img class="img-fluid" src="../../dist/img/SltravelLogo.jpg" alt="Sl Travel Logo" style="height:350px">
            
            </div>
      
        </div>

        
        <div class="row" style="margin-top: 20px">
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Boat on Calm Water"
                />
        
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Wintry Mountain Landscape"
                />
            </div>
        
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Mountains in the Clouds"
                />
        
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Boat on Calm Water"
                />
            </div>
        
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Waves at Sea"
                />
        
                <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp"
                    class="w-100 shadow-1-strong rounded mb-4"
                    alt="Yosemite National Park"
                />
            </div>
        </div>

        <h3 class="h3 text-center" style="font-size: 2rem">Our Hotels</h3>
        <div class="row">
            @foreach ($hotels as $hotel)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <img src="{{Storage::url($hotel->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="{{route('hotel', ['id' => $hotel->id])}}">
                            <h5 class="card-title text-left">
                                {{ $hotel->name }}
                                <br />
                                <span class="ratings">
                                    {{-- 4.5 Ratings --}}
                                </span>
                                <span class="location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{ $hotel->city_name }}
                                </span>
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
          
           
        </div>
    </div>

    <div class="container-fluid ">
        <div class="row text-center">
            <p class="h4 " >
                Watch the Beauty of Sri Lanka
            </p>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                <iframe src="https://www.youtube.com/embed/MbIPOgY9CTo?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                <iframe  src="https://www.youtube.com/embed/HUyZbTn3shI?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                <iframe src="https://www.youtube.com/embed/salEVVKMA_I?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                <iframe  src="https://www.youtube.com/embed/hAVUmnsKdeo?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
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