@extends('welcome')
@section('style')
<link rel="stylesheet" href="css/logReg.css" />
@endsection


@section('content')

<div class="container logReg">
    <div class="row">
        <div class="col-lg-6 mb-3">
          <img class="img-fluid" src="image/loginPic.png">
        </div>
        <div class="col-lg-6 mb-3" id="logCol" @if(!$errors->isEmpty() && !$errors->has('email')) style="display: none" @endif>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h6>Login</h6>
                <hr/>
                <div class="mb-3">
                    <label for="InputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="InputEmail1" aria-describedby="emailHelp1">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div id="emailHelp1" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="InputPassword1">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="Check1" name="remember">
                            <label class="form-check-label" for="Check1">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-lg-6 fpw">
                        <a href="{{ route('password.request') }}"> 
                            <i>
                                Forget Password?
                            </i>
                        </a>
                    </div>
                </div>
                
                <p class="text-mute">
                    By clicking Sign In, you agree to our Terms and that you have read our Data Policy,
                    including our Cookie Use Policy.You may be asked to verify your email address before you can sign in.
                </p>

                <div class="row">
                    <div class="col-lg-6 createAccount">
                        Dont Have an account? 
              
                            <button type="button" onclick="showReg()" class="showHideBtn">
                                Click Here
                            </button>
          
                        to create an account
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary" style="width:100%;color:#f1f1f1; text-decoration:none;">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6 mb-3" id="regCol" @if($errors->isEmpty() || $errors->has('email')) style="display: none" @endif>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h6>Register</h6>
                <hr/>
                <div class="mb-3">
                    <label for="reg_as" class="form-label">Register As</label>
                    <select class="form-control" name="reg_as" id="reg_as" style="border-radius: 20px !important;">
                        <option value="C">Customer</option>
                        <option value="V">Vendor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}">
                    @error('fname')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}">
                    @error('lname')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email_reg" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email_reg" name="email_reg" aria-describedby="emailHelp" value="{{ old('email_reg') }}">
                    @error('email_reg')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="Check1">
                    <label class="form-check-label" for="Check1">Remember Me</label>
                </div>
                {{-- <p class="text-mute">
                    By clicking Register, you agree to our Terms and that you have read our Data Policy,
                    including our Cookie Use Policy.You may be asked to verify your email address before you can sign in.
                </p> --}}

                <div class="row">
                    <div class="col-lg-6 createAccount">
                       Already a member? <button type="button" onclick="showLog()" class="showHideBtn">Click Here</button> to login
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary" style="width:100%;">Create Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showLog(){
      document.getElementById('logCol').style.display = 'block';
      document.getElementById('regCol').style.display = 'none';
    }

    function showReg(){
      document.getElementById('logCol').style.display = 'none';
      document.getElementById('regCol').style.display = 'block';
    }
</script>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#reg_as').change(function () {
            if (this.value == "V") {
                window.location = "{{route("vendor.create")}}";
            }
        })
    });
</script>
@endsection