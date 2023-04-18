@extends('layouts.app')
@push('styles')

@endpush

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger" role="alert">
  <strong>Error!</strong>{{session('error')}}
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card ">
    <div class="card-header text-center text-bold">
       <b>Activity Updation</b>
        <a href="{{route('activity.index')}}" class="btn btn-primary btn-sm float-end">Activity</a>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <form id="category_save" method="POST" action="{{route('verification.store')}}" enctype="multipart/form-data">
              @csrf
              @method('POST')
              <input type="hidden" name="model" value="{{$model}}">
              <input type="hidden" name="sub_stage_id" value="{{$sub_stage_id}}">
              <div class="row mb-3">
                <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Customer Type*</label>
                    <select name="customer_type" id="customer_type" class="form-control bg-light">
                      @foreach ($customer_types as $customer_type)
                      @if ($customer_type->id==$plan->customer->customer_type->id)
                          <option value="{{$customer_type->id}}"
                              selected
                          >{{$customer_type->name}}</option>
                          @endif
                      @endforeach
                    </select>
                    @error('customer_type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Customer*</label>
                    <select name="customer_id" id="customer_id" class="form-control select2 bg-light" required readonly>
                      @foreach($customers as $customer)
                      @if($customer->id==$plan->customer->id)
                      <option value="{{$customer->id}}" selected
                        @endif
                    >{{$customer->name}}</option>
                      @endforeach
                    </select>
                    @error('customer_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Part Number*</label>
                    <select name="part_number_id" id="part_number_id" class="form-control select2 bg-light" required readonly>
                      @foreach($part_numbers as $part_number)
                      @if ($part_number->id==$plan->part_number_id)
                      <option value="{{$part_number->id}}" selected>{{$part_number->name}}</option>
                      @endif
                      @endforeach
                    </select>
                    @error('part_number_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label for="" class="col-sm-6 col-form-label required">Timing Plan#</label>
                    <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" required class="form-control select2 bg-light" readonly>
                        @foreach($timing_plans as $timing_plan)
                        @if ($timing_plan->id==$plan->id)
                            <option value="{{$timing_plan->id}}"
                              selected
                            >{{$timing_plan->apqp_timing_plan_number}}</option>
                            @endif
                        @endforeach
                    </select>
                  </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Supplier Name*</label>
                <input type="text" readonly name="supplier" id="supplier" class="form-control bg-light"  value="{{$plan->supplier}}" readonly>
              </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Activity*</label>
                <input type="text" name="sub_stage" class="form-control bg-light" value="{{$sub_stage->name}}" readonly>
              </div>
              <div class="col-md-4">
                <label for="" class="col-sm-6 col-form-label required">Status*</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Select Status</option>
                    @if(auth()->user()->id==7)
                    <option value="3">Verified</option>
                    @endif
                    @if(auth()->user()->id===3 || auth()->user()->id==5 || auth()->user()->id==6 )
                    <option value="4">Approve</option>
                    @endif
                    <option value="5">Reject</option>
                </select>
                @error('status')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Preview*</label>
                {{-- <input type="button" name="sub_stage" class="form-control bg-light" value="{{$sub_stage->name}}" readonly> --}}
                {{-- <a class="btn btn-info form-control" href="{{route('verification/activity')}}/{{$plan->id}}">PREVIEW</a> --}}
                <a class="btn btn-info form-control" href="#">PREVIEW</a>
              </div>
              <div class="col-md-4">
                <label for="" class="col-sm-6 col-form-label required">Remarks*</label>
                <textarea name="remarks" id="remarks" cols="30" rows="5" class="form-control"></textarea>
                @error('remarks')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>


            </div>
                <button type="submit" id="submit" class="btn btn-primary" onclick="confirm('Are you sure?')">Save</button>
              </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#customer_id").select2({
        placeholder:"Select Customer",
        allowedClear:true,
    });
    $("#part_number_id").select2({
        placeholder:"Select Part Number",
        allowedClear:true,
    });
    $("#apqp_timing_plan_id").select2({
        placeholder:"Select Timing Plan",
        allowedClear:true,
    });
    $("#category_save").submit(function(e)
    {
      e.preventDefault();
      $.ajax({
        url:"{{route('save_register')}}",
        type:"POST",
        data:$(this).serialize(),
        success:function(response){
          alert(response);
        },
        error:function(response)
        {
          //var errors = $.parseJSON(response.responseText);
          $.each(response.responseJSON.errors,function(field_name,error){
                        $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">''</span>')
                        $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
                    })
          // var html ="<ul>";
          // $.each(errors, function (key, value) {
          //  // alert(value);
          //     html+="<li><span class='error'>"+value+"</span></li>";
          //     //$('#' + key).parent().addClass('error');
          // });
          // html+="</ul>";
          // $(".error_list").html(html);
        }
      });
    });
</script>
@endpush
