@extends('admin.layouts.default')

@section('title', 'Province Add')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Details</h3>

    </div>

    <form method="POST" action="{{ route("province.store") }}">
        @csrf
    <div class="card-body">

            <div class="row">
              <div class="col-sm-6">

                <div class="form-group">
                  <label>Province Name</label>
                  <input type="text" class="form-control" name="province_name" value="{{ old('province_name') }}">
                  @error('province_name')
                        <small class="text-danger">{{ $message }}</small >
                  @enderror
                </div>
              </div>

            </div>



    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route("province") }}" class="btn btn-info"> Back </a>
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary float-right" > Submit </button>
            </div>
          </div>
    </div>
</form>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->


  <!-- /.card -->

@endsection
