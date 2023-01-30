@extends('admin.layouts.default')

@section('title','Contact Requests')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Contact Request</h3>
    </div>
    <form>
        <fieldset disabled="disabled">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="f_name" name="f_name"
                                value="{{ $contactRequest->f_name }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="l_name" name="l_name"
                                value="{{ $contactRequest->l_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $contactRequest->email }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" id="message" rows="1" class="form-control">{{ $contactRequest->message }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection