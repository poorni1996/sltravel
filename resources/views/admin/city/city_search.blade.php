@extends('admin.layouts.default')

@section('title', 'City')

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
            <label>District</label>
            <select name="district_id" class="form-control">
              <option value="">Select</option>
              @foreach ($districts as $item )
              <option value="{{ $item->id  }}" {{old('district_id',Request::get('district_id', '1' ))==$item->id ? 'selected' : ''}}>{{ $item->district_name}}</option>
              @endforeach

            </select>
          </div>
        </div>

        <div class="col-sm-6">

          <div class="form-group">
            <label>City</label>
            <input type="text" class="form-control" name="city" value="{{ Request::get('city') }}">
          </div>
        </div>
      </div>



    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-6">
          {{-- <input type="reset" class="btn btn-default" value="Reset" /> --}}
          <button type="submit" class="btn btn-info"> Search </button>
        </div>
        <div class="col-sm-6">
          <a href="{{ route('city.create') }}" class="btn btn-primary float-right"> Add </a>
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

            <th>#</th>
            <th>District Name</th>
            <th>City Name</th>
            <th class="text-left">Action</th>


          </tr>
        </thead>
        <tbody>
          @foreach ($srcdata as $idx => $item)

          <tr>
            <td>{{ ($idx+1) }}</td>
            <td>{{$item->district_name}}</td>
            <td>{{$item->city_name }}</td>
            <td class="text-left" style="width:200px;">
              <a href="{{ route('city.show', array('id'=>$item->id) ) }}" type="submit" class="btn btn-info"> Show
              </a>
              <a href="{{ route('city.edit', array('id'=>$item->id) ) }}" type="submit" class="btn btn-warning">
                Edit </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>


    </div>
    <!-- /.card-body -->

  </form>
  <!-- /.card-footer-->
</div>
<!-- /.card -->





@endsection