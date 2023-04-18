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
    A simple success alert—check it out!
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="card">
        <div class="card-header text-center">
            <b>Manufacturing Feasibility Review</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('mfr.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Timing Plan#</label>
                            <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" class="form-control bg-light" readonly>
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
                            <select name="part_number_id" id="part_number_id" class="form-control bg-light" readonly>
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
                            <select name="application" id="application" class="form-control bg-light select2">
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
                            <select name="customer_id" id="customer_id" class="form-control bg-light select2">
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
                            <select name="product_description" id="product_description" class="form-control bg-light select2">
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
                            <label for="" class="col-sm-8 col-form-label required">File*</label>
                            <a href="{{url($location)}}/{{$mfr_data[0]->file}}" class="form-control btn btn-success btn-sm text-white" target="_blank">Download</a>
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table class="table table-responsive table-bordered" id="tab_logic">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Grid Ref.No</th>
                                    <th>PFD CON.IN.PRO.SEQ.NO
                                    </th>
                                    <th>PARAMETERS AS PER DRAWING</th>
                                    <th>SPECIFICATION AS PER DRAWING</th>
                                    <th>SC/CC,FFF,Past Trouble,TGW</th>
                                    <th>INITIAL SAMPLE LAYOUT INSPECTION</th>
                                    <th>MASS PRODUCTION</th>
                                    <th>FEASIBILITY CONFIRMATION</th>
                                    <th>&nbsp;&nbsp;CPK CMK&nbsp;&nbsp;</th>
                                    <th>REMARKS</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mfr_data as $mfr)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td  class="col-md-4"><input type="text" class="form-control bg-light" name="grid_ref_no[]" value="{{$mfr->grid_notes}}" readonly></td>
                                        <td><input type="text" class="form-control bg-light" name="pfd[]" value="{{$mfr->pfd_no}}"></td>
                                        <td><select name="parameter_as_per_drawing[]" class="form-control bg-light" readonly>
                                            {{-- <option value="Radius" {{ ($mfr->parameters_per_drawing=="Radius")? "selected" : "" }}>Radius</option>
                                            <option value="Dimension" {{ ($mfr->parameters_per_drawing=="Dimension")? "selected" : "" }}>Dimension</option>
                                            <option value="Material" {{ ($mfr->parameters_per_drawing=="Material")? "selected" : "" }}>Material</option>
                                            <option value="WireDia" {{ ($mfr->parameters_per_drawing=="WireDia")? "selected" : "" }}>WireDia</option>
                                            <option value="Angle" {{ ($mfr->parameters_per_drawing=="Angle")? "selected" : "" }}>Angle</option> --}}
                                            <option value="{{ $mfr->parameters_per_drawing }}" selected>{{ $mfr->parameters_per_drawing }}</option>
                                        </select></td>
                                        <td><input type="text" class="form-control bg-light" name="specification_as_per_drawing[]" value="{{$mfr->specification_per_drawing}}" readonly></td>
                                        <td><input type="text" class="form-control bg-light" name="past_trouble[]" value="{{$mfr->past_trouble}}"></td>
                                        <td><select name="initial_sample_layout_inspection[]" class="form-control bg-light" readonly>
                                            {{-- <option value="SupplierTC"  {{ ($mfr->initial_sample_layout_inspection=="SupplierTC")? "selected" : "" }}>SupplierTC</option>
                                            <option value="Micrometer"  {{ ($mfr->initial_sample_layout_inspection=="Micrometer")? "selected" : "" }}>Micrometer</option>
                                            <option value="ProfileProjector" {{ ($mfr->initial_sample_layout_inspection=="ProfileProjector")? "selected" : "" }}>ProfileProjector</option>
                                            <option value="DigitalVernier" {{ ($mfr->initial_sample_layout_inspection=="DigitalVernier")? "selected" : "" }}>DigitalVernier</option>
                                            <option value="LoadTestMechine" {{ ($mfr->initial_sample_layout_inspection=="LoadTestMechine")? "selected" : "" }}>LoadTestMechine</option> --}}
                                            <option value="{{ $mfr->initial_sample_layout_inspection }}" selected>{{ $mfr->initial_sample_layout_inspection }}</option>
                                        </select></td>
                                        <td><select name="mass_production[]" class="form-control bg-light" readonly>
                                            {{-- <option value="SupplierTC"  {{ ($mfr->mass_production=="SupplierTC")? "selected" : "" }}>SupplierTC</option>
                                            <option value="Micrometer"  {{ ($mfr->mass_production=="Micrometer")? "selected" : "" }}>Micrometer</option>
                                            <option value="ProfileProjector" {{ ($mfr->mass_production=="ProfileProjector")? "selected" : "" }}>ProfileProjector</option>
                                            <option value="DigitalVernier" {{ ($mfr->mass_production=="DigitalVernier")? "selected" : "" }}>DigitalVernier</option>
                                            <option value="LoadTestMechine" {{ ($mfr->mass_production=="LoadTestMechine")? "selected" : "" }}>LoadTestMechine</option> --}}
                                            <option value="{{ $mfr->mass_production }}" selected>{{ $mfr->mass_production }}</option>
                                        </select></td>
                                        <td  class="col-md-4"><input type="text" class="form-control bg-light" name="feasibility_confirmation[]" value="{{$mfr->feasibility_confirmation}}" readonly></td>
                                        <td  class="col-md-6"><input type="text" class="form-control bg-light" name="cpk_cmk[]" value="{{$mfr->cpk_cmk}}" readonly></td>
                                        <td  class="col-md-6"><textarea type="text" name="remarks[]" class="form-control bg-light" readonly>{{$mfr->remarks}}</textarea></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>No Activity Found!</td>
                                    </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <button type="button" id="submit" class="btn btn-primary align-center" onclick="confirm('Are you sure?')">Save</button> --}}
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
{{-- <script src="{{asset('js/select2.min.js')}}"></script> --}}
<script>
    $("#submit").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"{{ route('mfr.store') }}",
            type:"POST",
            data:$("#category_save").serialize(),
            success:function(response){
                alert(response);
            //     var result = $.parseJSON(response);
            //     $.toast({
            //       heading: 'Success',
            //       text: result.message,
            //       showHideTransition: 'plain',
            //       position: 'top-right',
            //       icon: 'success'
            //   });
            //location.reload(true);
            window.location.reload();
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
    $("#apqp_timing_plan_id").select2();
    $("#part_number_id").select2();
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
