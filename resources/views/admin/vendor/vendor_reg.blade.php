@extends('welcome')
@section('style')
<link rel="stylesheet" href="{{asset('css/hotel.css')}}" />
@endsection

@section('content')



<!-- Marketing messaging and featurettes
      ================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">


  <!-- START THE FEATURETTES -->

  <div class="row featurette">
    <div class="col-md-12">
      <h3 class="h3 title">Easy to Promote <span class="text-muted">your Place And Low Charged</span></h3>
      <h6 class="h6">Join with <span class="text-muted">us.</span></h6>
      <hr />
    </div>

  </div>

  <div class="row featurette">
    <div class="col-md-12">
      <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4">

            <div class="form-group">
              <label for="f_name">First Name</label>
              <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter first name"
                value="{{ old('f_name') }}">
              @error('f_name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">

            <div class="form-group">
              <label for="l_name">Last Name</label>
              <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter last name"
                value="{{ old('l_name') }}">
              @error('l_name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4">

            <div class="form-group">
              <label for="email">Email address</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter email"
                value="{{ old('email') }}">
              @error('email')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              @error('password')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
              @error('password_confirmation')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4">
            <div class="form-group">
              <label for="br">Business Registration</label>
              <input type="file" class="form-control" id="br" name="br">
              @error('br')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="phi_report">PHI Report</label>
              <input type="file" class="form-control" id="phi_report" name="phi_report">
              @error('phi_report')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
          </div>
        </div>
      </form>



    </div>

  </div>

  <hr class="featurette-divider">

  <!-- /END THE FEATURETTES -->

</div><!-- /.container -->


@endsection