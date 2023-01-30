@extends('admin.layouts.default')

@section('title', "Reports")

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
                        <label>Date From</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{$filters['from_date'] ?? ''}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date To</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{$filters['to_date'] ?? ''}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">All</option>
                            <option value="A" {{ isset($filters['status']) && $filters['status'] == 'A' ? 'selected' : '' }}>Pending Payment</option>
                            <option value="P" {{ isset($filters['status']) && $filters['status'] == 'P' ? 'selected' : '' }}>Paid</option>
                        </select>
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
        <h3 class="card-title">Payments</h3>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Customer</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->hotel_name }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>Rs. {{ number_format($booking->price, 2) }}</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>


@endsection