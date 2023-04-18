@extends('layouts.app')
@push('styles')

@endpush

@section('content')
<div class="card ">
    <div class="card-header">
       Enquiry Register Updation
        <a href="{{route('enquiry_register.index')}}" class="btn btn-primary btn-sm float-end">Enquiry Register</a>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <form id="category_save" method="POST" action="{{route('enquiry_register.update',$enquiry->id)}}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Customer*</label>
                        <select name="customer_id" id="customer_id" class="form-control select2 bg-light" required>
                          @foreach($customers as $customer)
                          @if ($customer->id==$enquiry->timing_plan->customer_id)
                          <option value="{{$customer->id}}"
                            selected
                        >{{$customer->name}}</option>
                          @endif

                          @endforeach
                        </select>
                        @error('customer_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Part Number*</label>
                        <select name="part_number_id" id="part_number_id" class="form-control select2 bg-light" required>

                          @foreach($part_numbers as $part_number)
                          @if ($part_number->id==$enquiry->timing_plan->part_number_id)
                          <option value="{{$part_number->id}}"
                            selected
                        >{{$part_number->name}}</option>
                          @endif
                          @endforeach
                        </select>
                        @error('part_number_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="" class="col-sm-6 col-form-label required">Timing Plan#</label>
                        <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" required class="form-control select2 bg-light">
                            @foreach($timing_plans as $timing_plan)
                            @if ($timing_plan->id==$enquiry->apqp_timing_plan_id)
                                <option value="{{$timing_plan->id}}"
                                  selected
                                >{{$timing_plan->apqp_timing_plan_number}}</option>
                                @endif
                            @endforeach
                        </select>
                      </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Supplier Name*</label>
                    <input type="text" readonly name="supplier" id="supplier" class="form-control bg-light" value="{{$plan->plan->supplier}}" readonly>
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Type Of Enquiry*</label>
                    <select name="type_of_enquiry" id="type_of_enquiry" class="form-control bg-light">
                      @foreach ($customer_types as $customer_type)
                      @if($customer_type->id==$enquiry->timing_plan->customer->customer_type_id)
                          <option value="{{$customer_type->id}}"
                              selected
                          @endif
                        >{{$customer_type->name}}</option>
                      @endforeach
                    </select>
                    @error('type_of_enquiry')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Received Date*</label>
                    <input type="date" name="received_date" id="received_date" class="form-control  @error('received_date') is-invalid @enderror" value="{{ $enquiry->received_date }}">
                    @error('received_date')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Average Annum Demand *</label>
                    <input type="text" name="average_annum_demand" id="average_annum_demand" class="form-control  @error('average_annum_demand') is-invalid @enderror" value="{{ $enquiry->average_annum_demand }}">
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
                  <div class="col-md-4 mt-5">
<<<<<<< HEAD
                    <a href="{{url($location)}}/{{$enquiry->enquiry_document}}" class="btn btn-success btn-sm text-white">Download</a>
=======
                    <a href="{{url($location)}}/{{$enquiry->enquiry_document}}" target="_blank" class="btn btn-success btn-sm text-white">Download</a>
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Status* <i class="bi bi-info-circle"></i></label>
                    <select class="form-control" name="status_id" id="">
                        <option value="">Select Status</option>
                        <option value="3">VERIFIED</option>
                        <option value="5">REJECTED</option>
                    </select>
                    @error('status_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label for="" class="col-sm-6 col-form-label required">Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control" cols="30" rows="5"></textarea>
                  </div>
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
    // $("#customer_id").select2({
    //     placeholder:"Select Customer",
    //     allowedClear:true,
    // });
    // $("#part_number_id").select2({
    //     placeholder:"Select Part Number",
    //     allowedClear:true,
    // });
    // $("#apqp_timing_plan_id").select2({
    //     placeholder:"Select Timing Plan",
    //     allowedClear:true,
    // });
</script>
@endpush
