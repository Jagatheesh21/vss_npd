@extends('layouts.app')
@push('styles')

@endpush

@section('content')
<div class="error_list">

</div>
<div class="card ">
    <div class="card-header text-center text-bold">
       <b>Enquiry Register Updation</b> 
        <a href="{{route('enquiry_register.index')}}" class="btn btn-primary btn-sm float-end">Enquiry Register</a>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <form id="category_save" method="POST" action="{{route('save_register')}}" enctype="multipart/form-data">
              @csrf
              @method('POST')
              
              <div class="row mb-3">
                <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Customer*</label>
                    <select name="customer_id" id="customer_id" class="form-control select2 bg-light" required readonly>
                      @foreach($customers as $customer)
                      <option value="{{$customer->id}}" @if (old('customer_id')==$customer->id || $plan->plan->customer_id==$customer->id) 
                        selected
                    @endif>{{$customer->name}}</option>
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
                      <option value="{{$part_number->id}}" @if (old('part_number_id')==$part_number->id || $plan->plan->part_number_id==$part_number->id)
                          selected
                      @endif>{{$part_number->name}}</option>
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
                        @if ($timing_plan->id==$plan->apqp_timing_plan_id)
                            <option value="{{$timing_plan->id}}" 
                              selected
                            >{{$timing_plan->apqp_timing_plan_number}}</option>
                            @endif
                        @endforeach
                    </select>
                  </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Supplier Name*</label>
                <input type="text" readonly name="supplier" id="supplier" class="form-control bg-light"  value="{{$plan->plan->supplier}}" readonly>
              </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Type Of Enquiry*</label>
                <select name="type_of_enquiry" id="type_of_enquiry" class="form-control bg-light">
                  @foreach ($customer_types as $customer_type)
                  @if ($customer_type->id==$plan->plan->customer->customer_type->id)
                      <option value="{{$customer_type->id}}" 
                          selected
                      >{{$customer_type->name}}</option>
                      @endif
                  @endforeach
                </select>
                @error('type_of_enquiry')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Received Date*</label>
                <input type="date" name="received_date" id="received_date" class="form-control @error('received_date') is-invalid @enderror " value="{{ old('received_date') }}">
                @error('received_date')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Average Annum Demand *</label>
                <input type="text" name="average_annum_demand" id="average_annum_demand" class="form-control @error('average_annum_demand') is-invalid @enderror" value="{{ old('average_annum_demand') }}">
                @error('average_annum_demand')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="name" class="col-sm-6 col-form-label required">Customer Enquiry* <i class="bi bi-info-circle"></i></label>
                <input type="file" name="enquiry_document" id="enquiry_document" class="form-control @error('enquiry_document') is-invalid @enderror">
                @error('enquiry_document')
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
