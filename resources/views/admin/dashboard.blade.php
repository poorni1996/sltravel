@extends('admin.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-3">
    @if (auth()->user()->user_role == "CUS" || auth()->user()->user_role == "VEN")
        <a href="{{route('hotel_booking.index')}}">
    @elseif(auth()->user()->user_role == "ADMIN")
        <a href="{{route('reports.bookings')}}">
    @endif
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$bookings_count}}</h3>
                    <p>Bookings</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{route('hotel_booking.index')}}">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$payments_count}}</h3>
                    @if (auth()->user()->user_role == "CUS")
                    <p>Payments</p>
                    @else
                    <p>Earnings</p>
                    @endif
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
        </a>
    </div>
    @if (auth()->user()->user_role == "ADMIN")
    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$user_count}}</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus"></i>
            </div>
        </div>
    </div>
    @endif
    @if (auth()->user()->user_role != "CUS")
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{$hotels_count}}</h3>
                <p>Hotels</p>
            </div>
            <div class="icon">
                <i class="fa fa-hotel"></i>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection