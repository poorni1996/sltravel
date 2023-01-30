@extends('admin.layouts.default')

@section('title','Wishlist')

@section('content')
<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title">Hotels</h3>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wishlist as $wish)
                <tr>
                    <td>{{ $wish->name }}</td>
                    <td>{{ number_format($wish->price, 2) }}</td>
                    <td>
                        <a href="{{ route('hotel', ['id' => $wish->hotel_id])}} " class="btn btn-primary">View Hotel</a>
                        <form action="{{ route('hotel_wishlist.destroy') }}" class="d-inline" method="POST">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $wish->hotel_id }}">
                            <button type="submit" class="btn btn-danger bookingBtn" title="Remove from Wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection