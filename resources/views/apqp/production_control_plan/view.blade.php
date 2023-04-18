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
                <form id="category_save" method="POST" action="{{route('proto_control_plan.store')}}" readonly>
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
                            <label for="name" class="col-sm-6 col-form-label required">Control Plan Type</label>
                            <select name="control_plan_type" id="control_plan_type" class="form-control select2 bg-light">
                                <option value="proto" selected>Proto</option>
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
                            <input type="text" name="revision_number" class="form-control bg-light" readonly value="{{$plan->revision_number}}" readonly>
                            @error('revision_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Date*</label>
                            <input type="text" name="revision_date" class="form-control bg-light" readonly value="{{$plan->revision_date}}" readonly>
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
                            <select name="core_team[]" id="core_team" class="form-control select2" multiple readonly>
                                @forelse ($productioncontrolplan_data as $key => $productioncontrolplan)
                                    @foreach ($users as $user)
                                    {{-- <option value="{{ $user->id }}" {{$productioncontrolplan->core_team[$key] == $user->id  ? 'selected' : ''}}>{{ $user->name}}</option> --}}
                                    <option value="{{ $productioncontrolplan->core_team[$key] }}" {{  ( $user->id == $productioncontrolplan->core_team[$key]) ? 'selected' : ''  }} >{{ $user->name}}</option>
                                    @endforeach
                                @empty
                                        <option value="">No Core Team</option>
                                @endforelse
                                {{-- @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{$productioncontrolplan_data[0]->core_team == $user->id  ? 'selected' : ''}}>{{ $user->name}}</option>
                                @endforeach
                                {{-- <option value="{{$productioncontrolplan_data[0]->core_team =="2"}}" selected>Mr.M.S. Vijayraghavan</option>
                                <option value="{{$productioncontrolplan_data[0]->core_team =="3"}}" selected>Mr.LDP</option>
                                <option value="{{$productioncontrolplan_data[0]->core_team =="4"}}" selected>Mr.Naveen</option>
                                <option value="{{$productioncontrolplan_data[0]->core_team =="5"}}" selected>Mr.Marimuthu</option>
                                <option value="{{$productioncontrolplan_data[0]->core_team =="6"}}" selected>Mr.Murugan</option>
                                <option value="{{$productioncontrolplan_data[0]->core_team =="7"}}" selected>Mr.uthuraja</option>
                                <option value="{{$productioncontrolplan_data[0]->core_team =="8"}}" selected>Mr.Kiruba</option>
                                <option value="{{$productioncontrolplan_data[0]->core_team =="9"}}" selected>Mr.Ajith</option> --}}
                            </select>
                            @error('core_team')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Model Reference*</label>
                            <input type="text" id="model_reference" name="model_reference" class="form-control bg-light" value="{{$productioncontrolplan_data[0]->supplier_plant_approval_date}}" selected readonly>
                            @error('model_reference')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Supplier Plant Approval Date*</label>
                            <input type="date" id="supplier_plant_approval_date" name="supplier_plant_approval_date" class="form-control bg-light" value="{{$productioncontrolplan_data[0]->supplier_plant_approval_date}}" readonly>
                            @error('supplier_plant_approval_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Customer Engineer Approval Date*</label>
                            <input type="date" id="customer_engineer_approval_date" name="customer_engineer_approval_date" class="form-control bg-light" value="{{$productioncontrolplan_data[0]->customer_engineer_approval_date}}" readonly>
                            @error('customer_engineer_approval_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Other Approval Date*</label>
                            <input type="date" id="other_approval_date" name="other_approval_date" class="form-control bg-light" value="{{$productioncontrolplan_data[0]->other_approval_date}}" readonly>
                            @error('other_approval_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Material Specification Norms*</label>
                            <input type="text" id="material_specification_norms" name="material_specification_norms" class="form-control bg-light" value="{{$productioncontrolplan_data[0]->material_specification_norms}}" readonly required>
                            @error('material_specification_norms')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">File*</label>
                            <a href="{{url($location)}}/{{$productioncontrolplan_data[0]->file}}" class="form-control btn btn-success btn-sm text-white" target="_blank">Download</a>
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Remarks*</label>
                            <textarea name="remarks" class="form-control bg-light" id="remarks" cols="30" rows="5" readonly required>{{$productioncontrolplan_data[0]->remarks}}</textarea>
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
                                    @forelse ($productioncontrolplan_data as $productioncontrolplan)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><div class="form-group">
                                            <div style="width:200px">
                                                <input type="text" class="form-control bg-light" name="process_seq_no[]" value="{{$productioncontrolplan->process_seq_no}}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <input type="text" class="form-control bg-light" name="tools_for_manufacturing[]" value="{{$productioncontrolplan->tools_for_manufacturing}}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <input type="text" class="form-control bg-light" name="s_no[]" value="{{$productioncontrolplan->s_no}}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <textarea name="product[]" class="form-control bg-light" cols="30" rows="5" readonly>{{$productioncontrolplan->product}}</textarea>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <input type="text" class="form-control bg-light" name="material_grade[]" value="{{$productioncontrolplan->material_grade}}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <input type="text" class="form-control bg-light" name="special_character[]" value="{{$productioncontrolplan->special_character}}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                            <div style="width:200px">
                                                <textarea  name="process_specification[]" cols="30" rows="5" class="form-control bg-light" readonly>{{$productioncontrolplan->process_specification}}</textarea>
                                            </div>
                                        </div>
                                    </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <textarea  name="measurement_technique[]" cols="30" rows="5" class="form-control bg-light" readonly>{{$productioncontrolplan->measurement_technique}}</textarea>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div style="width:200px">
                                                    <input type="text" name="size[]" class="form-control bg-light" value="{{$productioncontrolplan->size}}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div style="width:200px">
                                                    <input type="text" name="frequency[]" class="form-control bg-light" value="{{$productioncontrolplan->frequency}}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <textarea name="control_method[]" id="" cols="30" rows="5" class="form-control bg-light" readonly>{{$productioncontrolplan->control_method}}</textarea>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <textarea name="responsiblity[]" id="" cols="30" rows="5" class="form-control bg-light" readonly>{{$productioncontrolplan->responsiblity}}</textarea>
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class="form-group">
                                                <div style="width:200px">
                                                    <textarea name="reaction_plan[]" id="" cols="30" rows="5" class="form-control bg-light" readonly>{{$productioncontrolplan->reaction_plan}}</textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>No Activity Found!</td>
                                    </tr>
                                    @endforelse

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="{{asset('js/select2.min.js')}}" readonly></script>
<script>
   //$("#apqp_timing_plan_id").select2();
    //$("#part_number_id").select2();
    $("#core_team").select2();

    // On Submit
    $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('proto_control_plan.store')}}",
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
