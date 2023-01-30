@extends('admin.layouts.default')

@section('title','Approve or Reject Vendor')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Details</h3>
    </div>
    <form action="{{ route('vendor.apr_or_rej') }}" method="POST">
        <div class="card-body">
            <fieldset disabled="disabled">
                <div class="row">
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Registration No.</label>
                            <input type="text" class="form-control" id="registration_no">
                        </div>
                    </div> --}}

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Business Registration</label>
                            <div>
                                @if (isset($doc1))
                                <a href="{{ Storage::url($doc1->document) }}">Business Registration Document</a>
                                @else
                                No Documents Attached
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>PHI Report</label>
                            <div>
                                @if (isset($doc2))
                                <a href="{{ Storage::url($doc2->document) }}">PHI Report</a>
                                @else
                                No Documents Attached
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" name="email" value="{{ $vendor->email }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" value="{{ $vendor->fname }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" value="{{ $vendor->lname }}">
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Owner</label>
                            <input type="text" class="form-control" name="owner">
                        </div>
                    </div> --}}

                </div>

            </fieldset>
            <div class="row">
                @csrf
                <input type="hidden" name="id" value="{{ $vendor->id }}">
                <div class="col-md-4">
                    <label for="apr_or_rej">Status</label>
                    <select name="apr_or_rej" id="apr_or_rej" class="form-control">
                        <option value="">Please Select</option>
                        <option value="A">Approve</option>
                        <option value="R">Reject</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                    <button class="btn btn-primary float-right" type="submit">Submit</button>
                </div>

            </div>
        </div>
        <!-- /.card-footer-->

    </form>
</div>








@endsection