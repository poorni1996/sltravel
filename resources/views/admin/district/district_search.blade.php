@extends('admin.layouts.default')

@section('title', 'District')

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
                      <input type="text" class="form-control" name="district" value="{{ Request::get('district') }}">
                    </div>
                  </div>

                  <div class="col-sm-6">

                    <div class="form-group">
                      <label>Province</label>
                     <select name="province_id" class="form-control">
                        <option value="">Select</option>
                      @foreach ($province as $item )
                      <option value="{{ $item->id  }}"  {{old('province_id',Request::get('province_id')) == $item->province_id  ? 'selected' : ''}}>{{ $item->province_name}}</option>
                      @endforeach

                    </select>
                    </div>
                  </div>

                </div>



        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                  {{-- <input type="reset" class="btn btn-default" value= "Reset" /> --}}
                  <button type="submit" class="btn btn-info"> Search </button>
                </div>
                <div class="col-sm-6">
                  <a href="{{ route("district.create") }}" class="btn btn-primary float-right" > Add </a>
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
                <th>Province ID</th>
                <th>District Name</th>
                <th class ="text-left">Action</th>


              </tr>
            </thead>
            <tbody>
                @foreach ($srcdata as $idx => $item)

                <tr>
                    <td>{{ ($idx+1) }}</td>
                    <td>{{$item->province_name }}</td>
                    <td>{{$item->district_name}}</td>
                    <td class ="text-left" style="width:200px;">
                        <a href="{{ route("district.show", array("id"=>$item->id) ) }}" type="submit" class="btn btn-info" > Show </a>
                        <a href="{{ route("district.edit", array("id"=>$item->id) ) }}" type="submit" class="btn btn-warning" > Edit </a>
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

