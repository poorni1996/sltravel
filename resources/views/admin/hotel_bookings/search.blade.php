@extends('admin.layouts.default')

@section('title', 'Bookings')
@section('style')
<style>
    span.fa.fa-star.checked {
        color: #ffc700;
    }
</style>
@endsection
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
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Hotel Name</label>
                        <input type="text" class="form-control" name="hotel_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control" name="date">
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
                    <th>Hotel Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->hotel_name }}</td>
                    <td>{{ $booking->req_date }}</td>
                    <td>
                        @switch($booking->status)
                        @case("A")
                        Pending Payment
                        @break
                        @case("P")
                        Paid
                        @break
                        @case("D")
                        Removed
                        @break
                        @default
                        @endswitch
                    </td>
                    <td>{{ $booking->adults }}</td>
                    <td>{{ $booking->children }}</td>
                    <td>
                        <a href="{{ route('hotel', ['id' => $booking->hotel_id])}} "
                            class="btn btn-info">View Hotel</a>
                        <a href="{{ route('hotel_booking.show', ['id' => $booking->id])}} "
                            class="btn btn-info">View Booking</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection