@extends('admin.layouts.default')

@section('title','Hotels')

@section('content')
<div class="card card-primary card-outline">
    <form method="GET">
        <div class="card-header">
            <h3 class="card-title">Search</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $filters->name }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{ $filters->description }}">
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-info">Search</button>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('hotels.create') }}" class="btn btn-primary float-right">Add</a>
                </div>
            </div>
        </div>
        <!-- /.card-footer-->

    </form>
</div>


<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title">Results</h3>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td style="max-width: 200px;">{{ $hotel->description }}</td>
                    <td>{{ $hotel->price }}</td>
                    <td>
                        <a href="{{ route('hotels.edit', ['id' => $hotel->id])}}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('hotel_avl.search', ['hotel_id' => $hotel->id])}}" class="btn btn-info">Availability</a>
                        <a href="{{ route('hotel_acts.search', ['hotel_id' => $hotel->id])}}" class="btn btn-info">Activities</a>
                        <a href="{{ route('hotel_menu.search', ['hotel_id' => $hotel->id])}}" class="btn btn-info">Menu</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection