@extends('admin.layouts.default')

@section('title', 'Add Unavailable Date of Hotel - ' . $hotel->name)

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Details</h3>

    </div>

    <form method="POST" action="{{ route('hotel_avl.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                        @error('date')
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
                    <a href="{{ route('hotel_avl.search', ['hotel_id' => $hotel->id]) }}" class="btn btn-info"> Back </a>
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