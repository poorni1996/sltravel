@extends('admin.layouts.default')

@section('title', 'Province')

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
                      <label>Province Name</label>
                      <input type="text" class="form-control" name="province" value="{{ Request::get('province') }}">
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
                  <a href="{{ route("province.create") }}" class="btn btn-primary float-right" > Add </a>
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
                <th>Province Name</th>
                <th class ="text-left">Action</th>


              </tr>
            </thead>
            <tbody>
                @foreach ($srdata as $idx => $item)

                <tr>
                    <td>{{ ($idx+1) }}</td>
                    <td>{{$item["province_name"]}}</td>
                    <td class ="text-left" style="width:200px;">
                        <a href="{{ route("province.show", array("id"=>$item['id']) ) }}" type="submit" class="btn btn-info" > Show </a>
                        <a href="{{ route("province.edit", array("id"=>$item['id']) ) }}" type="submit" class="btn btn-warning" > Edit </a>
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

