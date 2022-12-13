@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="" class="form-inline">
            <div class="form-group">
                <label for="">Company Name</label>
                <input type="text" name="company_name" value="{!!$settings->company_name!!}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">GST Number</label>
                <input type="text" name="gst_number" value="{{$settings->gst_number}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Pan Number</label>
                <input type="text" name="pan_number" id="pan_number" value="{{$settings->pan_number}}" class="form-control">
            </div>
        </form> 
    </div>
    
</div>
@endsection
