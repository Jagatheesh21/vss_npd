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
            <b>Experience Sharing</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="quote_save" method="POST" enctype="multipart/form-data" action="{{route('experience_sharing.store')}}" >
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <input type="hidden" name="stage_id" value="1">
                        <input type="hidden" name="sub_stage_id" value="9">
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
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">File*</label>
<<<<<<< HEAD
                            <a href="{{url($location)}}/{{$tgw_data->file}}" class="form-control btn btn-success btn-sm text-white">Download</a>
=======
                            <a href="{{url($location)}}/{{$tgw_data->file}}" class="btn btn-success btn-sm text-white">Download</a>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-sm-8 col-form-label required">Remarks</label>
<<<<<<< HEAD
                            <textarea name="remarks" class="form-control bg-light" id="remarks" cols="30" rows="5">{{$tgw_data->remarks}}</textarea>
=======
                            <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5">{{$tgw_data->remarks}}</textarea>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                        </div>
                    </div>


<<<<<<< HEAD
                    {{-- <button type="submit" id="submit" class="btn btn-primary align-center" onclick="confirm('Are you sure?')">Save</button> --}}
=======
                    <button type="submit" id="submit" class="btn btn-primary align-center" onclick="confirm('Are you sure?')">Save</button>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script>

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
