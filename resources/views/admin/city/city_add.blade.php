@extends('admin.layouts.default')

@section('title', 'City Add')

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Details</h3>

  </div>

  <form method="POST" action="{{ route('city.store') }}">
    @csrf
    <div class="card-body">

      <div class="row">
        <div class="col-sm-6">

          <div class="form-group">
            <label>District</label>
            <select name="district_id" class="form-control">
              <option value="">Select</option>
              @foreach ($districts as $item )
              <option value="{{ $item->id  }}" {{old('district_id',Request::get('district_id', '1' ))==$item->id ? 'selected' : ''}}>{{ $item->district_name}}</option>
              @endforeach

            </select>
            @error('province_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

        <div class="col-sm-6">

          <div class="form-group">
            <label>City Name</label>
            <input type="text" class="form-control" name="description" value="{{ old('description') }}">
            @error('description')
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
          <a href="{{ route('district') }}" class="btn btn-info"> Back </a>
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