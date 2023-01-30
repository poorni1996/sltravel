@extends('admin.layouts.default')

@section('title', 'Province Show')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Details</h3>

    </div>

    <form method="POST" action="{{ route("province.delete", array("id"=>$shdata->id) ) }}">
        @csrf
    <div class="card-body">

            <div class="row">
              <div class="col-sm-6">

                <div class="form-group">
                  <label>Description</label>
                  <p class="form-control">{{ $shdata->province_name }}</p>
                </div>
              </div>

            </div>



    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route("province") }}" class="btn btn-info"> Back </a>
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-danger float-right" > Delete </button>
            </div>
          </div>
    </div>
</form>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->


  <!-- /.card -->

@endsection
