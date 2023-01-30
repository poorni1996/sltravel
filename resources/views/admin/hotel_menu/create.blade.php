@extends('admin.layouts.default')

@section('title', 'Add Menu Item to Hotel - ' . $hotel->name)

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Details</h3>

    </div>

    <form method="POST" action="{{ route('hotel_menu.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">

                <div class="row">
                    <div class="col">
                        <label for="">Galery Images</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <input type="file" class="form-control" name="gallery_images[]">
                    </div>
                    {{-- <div class="col-md-4 mt-2">
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
                    </div> --}}
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('hotel_menu.search', ['hotel_id' => $hotel->id]) }}" class="btn btn-info"> Back </a>
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