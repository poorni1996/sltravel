@extends('admin.layouts.default')

@section('title', 'Employee Registration')

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Details</h3>

  </div>

  <form method="POST" action="{{ route(" employee.store") }}">
    @csrf
    <div class="card-body">

      <div class="row">
        <div class="col-sm-6">

          <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" name="f_name" value="{{ old('f_name') }}">
            @error('f_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="l_name" value="{{ old('l_name') }}">
            @error('l_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">

          <div class="form-group">
            <label>E mail</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">

          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation">
            @error('password_confirmation')
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
          <a href="{{ route(" employee") }}" class="btn btn-info"> Back </a>
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