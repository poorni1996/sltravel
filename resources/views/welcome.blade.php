<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">

    <title>SL Travel</title>
    
    <link rel="stylesheet" href="{{asset('css/all.css')}}" />
    <!-- CSS only -->
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <style>
        span.req{
            color: #f00;
        }
    </style>
    @yield('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light indexNav" style="background-color: transparent !important; z-index: 10; padding: 20px;">
        <div class="container">
            <a class="navbar-brand" href="{{route('public_laniding')}}" style=" font-size: 25px; font-weight:900">
                SL Travel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public_hotels') }}">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public_destination') }}">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public_activity') }}">Activities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public_menu') }}">Hela Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('public_about')}}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('public_contact')}}">Contact Us</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">My Account</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">{{ auth()->user()->fname . ' ' . auth()->user()->lname }}</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    @yield('content')


    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="fcol col-lg-3 col-sm-12">
                    <h3 style="font-size: 30px;
                    color: #fe5d4c !important;
                    text-transform: uppercase;
                    font-weight: 600 !important;
                    letter-spacing: 0px;">
                       SL Travel
                    </h3>
                    <p>
                    You can choose your favourite destination and start planinng your long awaited vacation. We offer a multitude of rooms in amazing destinations and have a wide variety of hotels to suite your craving. Book your day outing with us today.
                    </p>
                    <div>
                        <a class="siconi" target="blank">
                            <i class=" fab fa-whatsapp"></i>
                        </a>
                        <a class="siconi" target="blank">
                            <i  class="fab fa-instagram"></i>
                        </a>
                        <a class="siconi" target="blank">
                            <i class=" fab fa-facebook"></i>
                        </a>
                    </div>
                </div>
        
         

            <div class="fcol col-lg-3 col-sm-6">
                <h3 class="fcaption">
                    Site Tree
                </h3>
                
                <hr class="caphr"/>
                
                <ul class="lists">
                    <li>
                        <a href="{{route('public_hotels')}}">Hotels</a>
                    </li>
                    <li>
                        <a href="{{ route('public_destination') }}">Destinations</a>
                    </li>
                    <li>
                        <a href="{{ route('public_activity') }}">Activities</a>
                    </li>
                    <li>
                        <a href="{{ route('public_menu') }}">Hela Menu</a>
                    </li>
                </ul>
            </div>

            <div class="fcol col-lg-3 col-sm-6">
                <h3 class="fcaption">
                   About Us
                </h3>
                
                <hr class="caphr"/>
                
                <ul class="lists">
                    <li>
                        <a href="{{ route('public_about') }}">About Us</a>
                    </li>
                    <li>
                        <a href="{{ route('public_contact') }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>

            <div class="fcol col-lg-3 col-sm-6">
                <h3 class="fcaption">
                    Get in tounch
                </h3>
                
                <hr class="caphr"/>
                
                <ul class="lists">
                    <li>
                        <i class="fas fa-street-view span"></i>
                        Sl Travels, Colombo, Sri Lanka
                    </li>
                    <li>
                        <i class="fas fa-phone-alt span"></i>
                      +94 123 456 7890
                    </li>
                    <li>
                        <i class="far fa-envelope-open span"></i>
                        info@sltravel.com
                    </li>
                </ul>
            </div>

                  
            <hr class="fhr"/>

            <div class="row">
                <div class="col-lg-6 col-sm-6 left">
                © Sl Travels - All rights reserved.
                </div>
                <div class="col-lg-6 col-sm-6 right">
                    Made with ❤ in Sri Lanka
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @if(Session::has('success'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 5000
            })
        });
    </script>
    @endif
    @if(Session::has('error'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: '{{ Session::get('error') }}',
                showConfirmButton: false,
                timer: 5000
            })
        });
    </script>
    @endif
    @yield('script')

  </body>
</body>

</html>