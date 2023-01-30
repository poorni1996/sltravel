@extends('admin.layouts.default')

@section('title', 'Edit Destination')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Details</h3>

    </div>

    <form method="POST" action="{{ route('destn.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$destn->id}}">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $destn->name) }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address', $destn->address) }}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description', $destn->description) }}">
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>City</label>
                        <select name="city_id" id="city_id" class="form-control">
                            <option value="">Select</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if(old('city_id', $destn->city_id) == $city->id) selected @endif>{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">

                <div class="row">
                    <div class="col">
                        <label for="">Galery Images <small>(Upload images only if you want to update)</small></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('destn.search') }}" class="btn btn-info"> Back </a>
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