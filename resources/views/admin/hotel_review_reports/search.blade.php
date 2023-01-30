@extends('admin.layouts.default')

@section('title', 'Reviews')
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
                        <label>E-mail</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="f_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="l_name">
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
                    <th>Hotel Name</th>
                    <th>Review</th>
                    <th>Rate</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->fname . ' ' . $review->lname }}</td>
                    <td>{{ $review->hotel_name }}</td>
                    <td>{{ $review->review }}</td>
                    <td>
                        <div>
                            @for ($i = 0; $i < 5; $i++) <span
                                class="fa fa-star {{ $i < $review->ratings ? 'checked' : '' }}"></span>
                                @endfor
                        </div>
                    </td>
                    <td>
                        @switch($review->status)
                        @case("A")
                        Active
                        @break
                        @case("R")
                        Reported
                        @break
                        @case("D")
                        Removed
                        @break
                        @default
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('hotel_review.report.show', ['id' => $review->id])}} "
                            class="btn btn-info">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection