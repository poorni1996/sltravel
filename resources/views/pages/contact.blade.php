@extends('welcome')
@section('style')
<link rel="stylesheet" href="css/contact.css" />
@endsection

@section('content')
<div class="container contact">
    <div class="row">
        <div class="col-lg-8">
            <h3 class="header">
                Talk to us
            </h3>
            <p class="btext">
                Get in touch with us regarding your travel desitination inquiery and many more !
            </p>

            <form action="{{route('contact.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="information" class="form-label">Information</label>
                    <select id="propertyType" name="person_type" class="form-select">
                        <option selected>Select</option>
                        <option value="H">I am a Hotel Owner</option>
                        <option value="C">I am a Traveler</option>
                    </select>
                    @error('person_type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="f_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="John">
                        @error('f_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="l_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Smith">
                        @error('l_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@sltravel.com">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                    @error('message')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-default submit">Submit Inquery</button>
            </form>

        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <h3 class="head">
                    For inquiries contact :
                </h3>

                <p class="contactdetails">
                    info@sltravel.com
                </p>

                <h6 class="iname">
                    Poornima
                </h6>

                <p class="contactdetails">
                    poornima@sltravel.com
                    <br />
                    +94 77 123 4567
                </p>


                <div class="social">
                    <a class="siconi" target="blank">
                        <i class=" fab fa-whatsapp"></i>
                    </a>
                    <a class="siconi" target="blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="siconi" target="blank">
                        <i class=" fab fa-facebook"></i>
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection