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
            <b>Production Control Plan</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('production_control_plan.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Control Plan#</label>
                              <input type="text" name="control_plan_number" class="form-control bg-light" value="VS / CP / 1874" readonly>
                              @error('control_plan_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Key Contact *</label>
                              <input type="text" name="key_contact" class="form-control bg-light" value="DHANAPAL L/0422-2680840" readonly>
                              @error('key_contact')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Control Plan Type*</label>
                            <select name="control_plan_type" id="control_plan_type" class="form-control select2 bg-light">
                                <option value="production" selected>Production</option>
                            </select>
                            @error('control_plan_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="name" class="col-sm-12 col-form-label required">Document Number#</label>
                            <input type="text" name="document_number" class="form-control bg-light" value="NPD/DI/D/05">
                            @error('document_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
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
                            <input type="text" name="revision_number" class="form-control bg-light" readonly value="{{$plan->revision_number}}">
                            @error('revision_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Date*</label>
                            <input type="text" name="revision_date" class="form-control bg-light" readonly value="{{$plan->revision_date}}">
                            @error('revision_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Customer Type*</label>
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
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Core Team*</label>
                            <select name="core_team[]" id="core_team" class="form-control select2" multiple>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('core_team')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Model Reference*</label>
                            <input type="text" id="model_reference" name="model_reference" class="form-control" value="M&M W601">
                            @error('model_reference')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Supplier Plant Approval Date*</label>
                            <input type="date" id="supplier_plant_approval_date" name="supplier_plant_approval_date" class="form-control" value="M&M W601">
                            @error('supplier_plant_approval_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Customer Engineer Approval Date*</label>
                            <input type="date" id="customer_engineer_approval_date" name="customer_engineer_approval_date" class="form-control" value="M&M W601">
                            @error('customer_engineer_approval_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Other Approval Date*</label>
                            <input type="date" id="other_approval_date" name="other_approval_date" class="form-control" value="M&M W601">
                            @error('other_approval_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Material Specification Norms*</label>
                            <input type="text" id="material_specification_norms" name="material_specification_norms" class="form-control" required>
                            @error('material_specification_norms')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="overflow-x: auto">
                            <table class="table table-bordered text-center" id="tab_logic">
                                <thead >
                                <tr class="text-center bg-light" >
                                    <th rowspan="3">S.No</th>
                                    <th rowspan="3">Process Seq no.</th>
                                    <th rowspan="3">MACHINE, DEVICE, JIG, TOOLS
                                        for Mfg</th>
                                    <th colspan="3">Characteristics</th>
                                    <th rowspan="3">SPL CHAR/CLASS</th>
                                    <th colspan="6">METHODS</th>
                                    <th rowspan="3">REACTION PLAN</th>
                                </tr>
                                <tr class="text-center bg-light">
                                    <th rowspan="2">S.No</th>
                                    <th rowspan="2">Product</th>
                                    <th rowspan="2">Process</th>
                                    <th rowspan="2">PRODUCT / PROCESS SPECIFICATION / TOLERANCE</th>
                                    <th rowspan="2">EVALUATION / MEASUREMENT TECHNIQUE</th>
                                    <th colspan="2">SAMPLE</th>
                                    <th rowspan="2">CONTROL METHOD</th>
                                    <th rowspan="2">RESPONSIBILITY</th>
                                </tr>
                                <tr class="text-center bg-light">
                                    <th>SIZE</th>
                                    <th>FREQ</th>
                                </tr>
                                </thead>
                                <tbody class="col-md-12">
                                {{-- STEP 1 STARTS --}}
                                <tr id='addr0'>
                                    <td>1</td>
                                    <td>
                                    <input type="text" name="process_seq_no[]" class="form-control" >
                                    </td>
                                    <td>
                                        <div style="width:150px">
                                            <input type="text" name="tools_for_manufacturing[]" class="form-control" >
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:50px">
                                            <input type="text" name="s_no[]" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <textarea name="product[]" class="form-control" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <input type="text" name="material_grade[]" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <select name="special_character[]" class="form-control select2">
                                                    <option value=""></option>
                                                    <option value="significent">SIGNIFICANT </option>
                                                    <option value="critical">CRITICAL</option>
                                                    <option value="vss">VSS IDENTIFIED SF/CC/FFF</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <textarea name="process_specification[]" class="form-control" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <textarea  name="measurement_technique[]" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <input type="text" name="size[]" class="form-control" >
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <input type="text" name="frequency[]" class="form-control" >
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <textarea name="control_method[]" id="" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <input type="text" name="responsiblity[]" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div style="width:200px">
                                                <textarea name="reaction_plan[]" id="" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- STEP 1 -ENDS --}}
                                <tr id="addr1">

                                </tr>
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
                      <div class="row mb-3 clearfix">
                      <div class="col-md-12 ">
                            <button type="button" id="submit" class="btn btn-primary align-center" onclick="confirm('Are you sure?')">Save</button>
                      </div>
                      </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
   //$("#apqp_timing_plan_id").select2();
    //$("#part_number_id").select2();
    $("#core_team").select2();

    // On Submit
    $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('production_control_plan.store')}}",
            type:"POST",
            data:$("#category_save").serialize(),
            success:function(response)
            {
                $.toast({
                  heading: 'Success',
                  text: response.message,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'success'
              });
              location.reload();
            },
            error:function(response)
            {
                var result = $.parseJSON(response.responseText);
                $.each(result.errors, function(key, val) {
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
