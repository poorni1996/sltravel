@extends('admin.layouts.default')

@section('title', "Activities in Hotel - " . $hotel->name)

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
                    <a href="{{ route('hotel_acts.create', ['hotel_id' => $hotel->id]) }}" class="btn btn-primary float-right">Add</a>
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
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $activity)
                <tr>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>
                        <a href="{{ route('hotel_acts.edit', ['hotel_id' => $activity->hotel_id, 'id' => $activity->id])}} "
                            class="btn btn-warning">Edit</a>
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