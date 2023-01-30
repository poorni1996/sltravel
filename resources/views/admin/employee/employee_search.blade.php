@extends('admin.layouts.default')

@section('title', 'Employee Search')

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Search</h3>

  </div>

  <form>
    <div class="card-body">

      <div class="row">
        <div class="col-sm-6">

          <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" name="empfname" value="{{ Request::get('empfname') }}">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="emplname" value="{{ Request::get('emplname') }}">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>E-mail</label>
            <input type="text" class="form-control" name="empemail" value="{{ Request::get('empemail') }}">
          </div>
        </div>


      </div>



    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-6">
          <button type="submit" class="btn btn-info"> Search </button>
        </div>
        <div class="col-sm-6">
          <a href="{{ route('employee.create') }}" class="btn btn-primary float-right"> Add </a>
        </div>
      </div>
    </div>
  </form>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Result</h3>

  </div>
  {{--
  @dump($mydata) --}}

  <form>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>

            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th class="text-left">Action</th>


          </tr>
        </thead>
        <tbody>
          {{-- @for ($i = 0; $i < count($mydata); $i++) --}} @foreach ($mydata as $item) <tr>
            <td>{{$item["fname"]}}</td>
            <td>{{$item["lname"]}}</td>
            <td>{{$item["email"]}}</td>
            <td class="text-left" style="width:200px;">
              <a href="{{ route('employee.show', array("id"=>$item['id']) ) }}" type="submit" class="btn btn-info" >
                Show </a>
              <a href="{{ route('employee.edit', array("id"=>$item['id']) ) }}" type="submit" class="btn btn-warning" >
                Edit </a>
            </td>
            </tr>
            @endforeach
            {{-- @endfor --}}

        </tbody>
      </table>





    </div>
    <!-- /.card-body -->

  </form>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

@endsection