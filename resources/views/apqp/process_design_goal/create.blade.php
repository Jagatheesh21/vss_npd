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
    <strong>Error!</strong> {{session('error')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="card">
        <div class="card-header text-center">
            <b>Process Design Goals</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST"  enctype="multipart/form-data" action="{{route('process_design_goal.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Timing Plan#</label>
                            <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" class="form-control select2 bg-light">
                                @foreach ($plans as $t_plan)
                                    @if ($t_plan->id==$plan->id)
                                    <option value="{{$t_plan->id}}" selected>{{$t_plan->apqp_timing_plan_number}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('apqp_timing_plan_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Part Number*</label>
                            <select name="part_number_id" id="part_number_id" class="form-control select2 bg-light">
                                @foreach ($part_numbers as $part_number)
                                    @if ($part_number->id==$plan->part_number_id)
                                    <option value="{{$part_number->id}}" selected>{{$part_number->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('part_number_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Number*</label>
                            <input type="text" name="revision_number" class="form-control bg-light" value="{{$plan->revision_number}}" readonly>
                            @error('revision_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Date*</label>
                            <input type="text" name="revision_date" class="form-control bg-light" value="{{$plan->revision_date}}" readonly>
                            @error('revision_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Application*</label>
                            <select name="application" id="application" class="form-control select2 bg-light">
                                @foreach ($customer_types as $customer_type)
                                    @if ($customer_type->id==$plan->customer->customer_type->id)
                                    <option value="{{$customer_type->id}}" selected>{{$customer_type->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('application')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Customer*</label>
                            <select name="customer_id" id="customer_id" class="form-control select2 bg-light">
                                @foreach ($customers as $customer)
                                    @if ($customer->id==$plan->customer_id)
                                    <option value="{{$customer->id}}" selected>{{$customer->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('customer_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Product Description*</label>
                            <select name="product_description" id="product_description" class="form-control select2 bg-light">
                                @foreach ($part_numbers as $part_number)
                                    @if ($part_number->id==$plan->part_number_id)
                                    <option value="{{$part_number->id}}" selected>{{$part_number->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('product_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="" class="col-sm-8 col-form-label required">File*</label>
                            <input type="file" name="file" id="file" class="form-control">
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Remarks*</label>
                            <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12" style="overflow-x:auto">
                            <table class="table table-responsive table-bordered text-center" id="tab_logic">
                                <thead>
                                <tr>
                                    <th rowspan="2">S.No</th>
                                    <th rowspan="2">PROCESS DESCRIPTION</th>
                                    <th colspan="4">TARGET</th>
                                    <th colspan="4">ACTUAL</th>
                                </tr>
                                <tr>
                                    <th>COST</th>
                                    <th>QUALITY in PPM</th>
                                    <th>OUTPUT/Hr</th>
                                    <th>Cpk</th>
                                    <th>COST</th>
                                    <th>QUALITY in PPM</th>
                                    <th>OUTPUT/Hr</th>
                                    <th>Cpk</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id='addr0'>
                                    <td>1</td>
                                    <td>
                                        <div style="width:200px;">
                                            <textarea name="process_description[]" class="form-control" cols="30" rows="5"></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:150px;">
                                        <input type="text" name="target_cost[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:200px;">
                                        <input type="text" name="target_quality[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:200px;">
                                        <input type="text" name="target_output[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:200px;">
                                        <input type="text" name="target_cpk[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:200px;">
                                        <input type="text" name="actual_cost[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:200px;">
                                        <input type="text" name="actual_quality[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:200px;">
                                        <input type="text" name="actual_output[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:200px;">
                                        <input type="text" name="actual_cpk[]" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr id='addr1'></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3 clearfix">
                        <div class="col-md-12 ">
                          <button id="add_row" type="button" class="btn btn-primary pull-left">Add Row</button>
                          <button id='delete_row' type="button" class="float-end btn btn-danger text-white" onclick="confirm('Are you Sure, Want to Delete the Row?')">Delete Row</button>
                        </div>
                      </div>

                    <button type="button" id="submit" class="btn btn-primary align-center" onclick="confirm('Are you sure?')">Save</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#submit").click(function(e){
        e.preventDefault();
        var formData = new FormData($("#category_save")[0]);
        $.ajax({
            url:"{{ route('process_design_goal.store') }}",
            type:"POST",
            data: formData,
            processData: false,
            contentType: false,
            success:function(response){

                //var result = $.parseJSON(response);
                var url = "{{route('activity.index')}}";
                $.toast({
                  heading: 'Success',
                  text: response.message,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'success'
              });
              window.location.href=url;
           // location.reload(true);
            },
            error:function(result)
            {
                var response = $.parseJSON(result.responseText);
            $.each(response.errors, function(key, val) {
              $.toast({
                  heading: 'Error',
                  text: val,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'error'
              })
            })
            }
        });
    });
    // $("#apqp_timing_plan_id").select2();
    // $("#part_number_id").select2();
    var i=1;
    $("#add_row").click(function(){b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++;
  	});
      $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
	});
</script>
@endpush
