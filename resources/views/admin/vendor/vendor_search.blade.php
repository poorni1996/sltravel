@extends('admin.layouts.default')

@section('title','Approve or Reject Vendor')

@section('content')
<div class="card card-primary card-outline">
    <form method="GET">
        <div class="card-header">
            <h3 class="card-title">Search</h3>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-md-4">
                    <div class="form-group">
                        <label>Business Registration No.</label>
                        <input type="text" class="form-control" id="business_registration_no">
                    </div>
                </div> --}}

                <div class="col-md-4">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                </div> --}}
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
                    {{-- <th>Business Registration No.</th> --}}
                    <th>Email</th>
                    {{-- <th>Address</th> --}}
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->fname }}</td>
                    <td>{{ $vendor->lname }}</td>
                    <td>
                        <a href="{{ route('vendor.show', ['id' => $vendor->id])}}" class="btn btn-primary">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>





@endsection