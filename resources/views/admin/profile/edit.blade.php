@extends('admin.layouts.default')

@section('title', 'Profile')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Details</h3>

    </div>

    <form method="POST" action="{{ route('user_profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="fname" value="{{ old('fname', $user->fname) }}">
                        @error('fname')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lname" value="{{ old('lname', $user->lname) }}">
                        @error('lname')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input type="file" class="form-control" name="profile_pic">
                        @error('prof_pic')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('employee') }}" class="btn btn-info"> Back </a>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary float-right"> Submit </button>
                </div>
            </div>
        </div>
    </form>
    <!-- /.card-footer-->
</div>
<!-- /.card -->


<!-- /.card -->

@endsection