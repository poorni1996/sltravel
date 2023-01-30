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
    <div class="card-header">
        <h3 class="card-title">Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-2">
                <label class="mb-0">Hotel</label>
                <div>{{ $booking->hotel_name }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Date</label>
                <div>{{ $booking->req_date }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Name</label>
                <div>{{ $booking->name }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Status</label>
                <div>
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
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Contact No</label>
                <div>{{ $booking->contact_no }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">E-mail</label>
                <div>{{ $booking->email }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Adults</label>
                <div>{{ $booking->adults }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Children</label>
                <div>{{ $booking->children }}</div>
            </div>
            <div class="col-md-4 mb-2"></div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Price Per Adult</label>
                <div>Rs. {{ number_format($booking->hotel_price, 2) }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Price Per Child</label>
                <div>Rs. {{ number_format($booking->hotel_child_price, 2) }}</div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="mb-0">Total Price</label>
                <div>Rs. {{ number_format(($booking->hotel_price * $booking->adults) + ($booking->hotel_child_price * $booking->children), 2) }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($booking->status == "A")
                <form action="{{ route('pay_test') }}">
                    <input type="hidden" name="id" value="{{ $booking->id }}">
                    <input type="hidden" name="description"
                        value="Payment for book hotel {{ $booking->hotel_name }} on {{ $booking->req_date }}.">
                    <input type="hidden" name="price" value="{{ (($booking->hotel_price * $booking->adults) + ($booking->hotel_child_price * $booking->children)) * 0.50 }}">
                    <button class="btn btn-primary float-right" type="submit">Pay</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->


<!-- /.card -->

@endsection