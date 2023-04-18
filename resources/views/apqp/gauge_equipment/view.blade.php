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
            <b>Identification Of Gauge and Testing Equipment</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('gauge_equipment.store')}}" enctype="multipart/form-data">
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
                            <label for="" class="col-sm-6 col-form-label required">Application*</label>
                            <select name="application" id="application" class="form-control bg-light" readonly>
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
                            <select name="customer_id" id="customer_id" class="form-control bg-light" readonly>
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
                            <select name="product_description" id="product_description" class="form-control bg-light" readonly>
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

                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table class="table table-responsive table-bordered" id="tab_logic">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Stage</th>
                                    <th>Gauge No.</th>
                                    <th>To Check</th>
                                    <th>Sample Size</th>
                                    <th>Frequency</th>
                                    <th>Reference File</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($gaugeequipments as $gaugeequipment)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><input type="text" class="form-control bg-light" name="stage[]" value="{{$gaugeequipment->stage}}" readonly></td>
                                        <td><input type="text" class="form-control bg-light" name="gauge_number[]" value="{{$gaugeequipment->gauge_number}}"></td>
                                        <td><input type="text" class="form-control bg-light" name="to_check[]" value="{{$gaugeequipment->to_check}}"></td>
                                        <td><input type="text" class="form-control bg-light" name="sample_size[]" value="{{$gaugeequipment->sample_size}}"></td>
                                        <td><input type="text" class="form-control bg-light" name="frequency[]" value="{{$gaugeequipment->frequency}}"></td>
                                        <td><a href="{{url($location)}}/{{$gaugeequipment->photo}}" class="btn btn-success btn-sm text-white" target="_blank">Download</a>
                                        </td>
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
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
{{-- <script src="{{asset('js/select2.min.js')}}"></script> --}}
<script>
    $("#apqp_timing_plan_id").select2();
    $("#part_number_id").select2();
    $("#submit").click(function(){
        $.ajax({
            url:"{{route('gauge_equipment.store')}}",
            type:"POST",
            data:$("#category_save").serialize(),
            success:function(result)
            {
                var response = $.parseJSON(result);
                $.toast({
                    heading: 'Success',
                    text: response.message,
                    showHideTransition: 'plain',
                    position: 'top-right',
                    icon: 'success'
                });
                location.reload();
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
                });
                });
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
