@extends('admin.layouts.default')

@section('title', 'Review')
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
        <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
                <h5>{{ $review->hotel_name }}</h5>
                <hr class="mt-0" />
                <h6 class="mb-0">{{ $review->fname . ' ' . $review->lname }}</h6>
                <hr class="mt-0" />
                <p class="card-text">
                <div class="row">
                    <div class="col">
                        <div>
                            {{-- <span><b>{{$review->ratings}}</b></span> --}}
                            @for ($i = 0; $i < 5; $i++) <span
                                class="fa fa-star {{ $i < $review->ratings ? 'checked' : '' }}"></span>
                                @endfor
                        </div>
                    </div>
                </div>
                {{ $review->review }}
                </p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('hotel_review.report.destroy') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $review->id }}">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Report Reason</label>
                        <textarea class="form-control" disabled name="report_reason" id="report_reason"
                            rows="1">{{ old('report_reason', $review->report_reason) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Action</label>
                        <select id="action" class="form-control" name="action">
                            <option>Select Decision</option>
                            <option value="D">Remove</option>
                            <option value="K">Keep</option>
                        </select>
                        @error('action')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Review Remove Reason</label>
                        <textarea class="form-control" name="removed_reason" id="removed_reason"
                            rows="1">{{ old('removed_reason', $review->removed_reason) }}</textarea>
                        @error('removed_reason')
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
                    <a href="{{ route('hotel_review.search') }}" class="btn btn-info"> Back </a>
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