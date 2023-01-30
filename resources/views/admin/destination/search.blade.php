@extends('admin.layouts.default')

@section('title', "Destinations")

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
                        <label>E-mail</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div> --}}
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
                    <a href="{{ route('destn.create') }}" class="btn btn-primary float-right">Add</a>
                </div>
            </div>
        </div>
        <!-- /.card-footer-->

    </form>
</div>

<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title">Result</h3>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($destinations as $destination)
                <tr>
                    <td>{{ $destination->name }}</td>
                    <td>{{ $destination->address }}</td>
                    <td>{{ $destination->description }}</td>
                    <td>
                        <a href="{{ route('destn.edit', ['id' => $destination->id]) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>
                        No Activities to Show
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>


@endsection