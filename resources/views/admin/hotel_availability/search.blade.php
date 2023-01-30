@extends('admin.layouts.default')

@section('title', "Unavailable Dates of Hotel - " . $hotel->name)

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
                        <label>Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $filters['date'] ?? '' }}">
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
                    <a href="{{ route('hotel_avl.create', ['hotel_id' => $hotel->id]) }}" class="btn btn-primary float-right">Add</a>
                </div>
            </div>
        </div>
        <!-- /.card-footer-->

    </form>
</div>

<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title">Result</h3>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($avl_items as $avl_item)
                <tr>
                    <td>{{ $avl_item->blocked_date }}</td>
                    <td>
                        <a href="{{ route('hotel_avl.delete', ['hotel_id' => $avl_item->hotel_id, 'id' => $avl_item->id])}} "
                            class="btn btn-danger">Remove</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>
                        No Unavailable Dates to Show
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>


@endsection