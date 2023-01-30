@extends('admin.layouts.default')

@section('title','Contact Requests')

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
                        <label>First Name</label>
                        <input type="text" class="form-control" id="f_name" name="f_name">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="l_name" name="l_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <button type="add" class="btn btn-info">Search</button>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contactRequests as $req)
                <tr>
                    <td>{{ $req->f_name }}</td>
                    <td>{{ $req->l_name }}</td>
                    <td>{{ $req->email }}</td>
                    <td>{{ Str::limit($req->message, 20) }}</td>
                    <td>
                        <a href="{{ route('contact.show', $req->id) }}" class="btn btn-info">View</a>
                        {{-- <a href="{{ route('admin.contact.delete', $req->id) }}" class="btn btn-danger">Delete</a> --}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No Data Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {!! $contactRequests->links() !!}
    </div>
    <!-- /.card-body -->
</div>





@endsection