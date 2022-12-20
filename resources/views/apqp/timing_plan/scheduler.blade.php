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
        <div class="card-header">
            Schedule Timing Plan 
            <a href="{{route('apqp_timing_plan.index')}}" class="btn btn-primary btn-sm float-end">Timing Plans</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Customer*</label>
                        <select name="customer_id" id="customer_id" class="form-control select2" required>
                          <option value=""></option>
                          @foreach($customers as $customer)
                          <option value="{{$customer->id}}" @if (old('customer_id')==$customer->id)
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
                        <select name="part_number_id" id="part_number_id" class="form-control select2" required>
                          <option value=""></option>
                          @foreach($part_numbers as $part_number)
                          <option value="{{$part_number->id}}" @if (old('part_number_id')==$part_number->id)
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
                        <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" required class="form-control select2">
                            <option value="">Select Part Number First</option>
                        </select>
                      </div>
                      
                    </div>
                    <div class="row mb-3 activities">
                      
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
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
        
        $("#part_number_id").change(function(e){
            e.preventDefault();
            var part_number = $(this).val();
            var customer_id = $("#customer_id").val();
            if(part_number!="" && part_number!=null)
            {
                $.ajax({
                    url:"{{route('plans')}}",
                    type:"POST",
                    data:{part_number:part_number,customer_id:customer_id},
                    success:function(response)
                    {
                        var result = JSON.parse(response);
                        $("#apqp_timing_plan_id").append("<option value=''>Select Timing Plan</option>");
                        $.each(result, function (index, optiondata) {
                            $("#apqp_timing_plan_id").append("<option value='" + optiondata.id + "'>" + optiondata.apqp_timing_plan_number + "</option>");
                        });
                    }
                });
            }
        });
        $("#apqp_timing_plan_id").change(function(e){
            e.preventDefault();
            if($(this).val()=="" || $(this).val()==null || $(this).val()==undefined){
                return false;
            }
            $.ajax({
                url:"{{route('plan_activities')}}",
                type:"POST",
                data:{timing_plan_id:$(this).val()},
                success:function(response)
                {
                    if(response.html)
                    {
                      $(".responsibility").select2();  
                      $(".activities").html(response.html);
                    }
                }
            });

        });
      $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
          url:"{{route('scheduler_update')}}",
          type:"POST",
          data:$("#category_save").serialize(),
          success:function(response)
          {

          },
          error: function (reject) {
                if( reject.status === 422 ) {
                  $.each(reject.responseJSON.errors,function(field_name,error){
                    //swal("Error!",+error+);    
                    //$(document).find('[name='+field_name+']').after('');
                            //$(document).find('[name='+field_name+']').after('<br><span class="text-strong text-danger">' +error+ '</span>')
                        })
                }
            }
        });
      });
    </script>
@endpush