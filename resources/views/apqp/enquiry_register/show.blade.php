@extends('layouts.app')
@push('styles')

@endpush

@section('content')
<div class="card ">
    <div class="card-header text-center text-bold">
       <b>Enquiry Register</b>
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
                    <input type="date" name="received_date" id="received_date" class="form-control  @error('received_date') is-invalid @enderror bg-light" value="{{ $enquiry->received_date }}" readonly>
                    @error('received_date')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Average Annum Demand *</label>
                    <input type="text" name="average_annum_demand" id="average_annum_demand" class="form-control  @error('average_annum_demand') is-invalid @enderror bg-light" value="{{ $enquiry->average_annum_demand }}" readonly>
                    @error('average_annum_demand')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Customer Enquiry* <i class="bi bi-info-circle"></i></label>
                        <a href="{{url($location)}}/{{$enquiry->enquiry_document}}" target="_blank" class="form-control btn btn-success btn-sm text-white">Download</a>
                    @error('enquiry_document')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="col-sm-8 col-form-label required">ERN Sample*</label>

                        <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ern_sample" id="inlineRadio1" value="YES" @if($enquiry->ern_sample=='YES') checked @endif readonly >
                            <label class="form-check-label" for="inlineRadio1">YES</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ern_sample" id="inlineRadio2" value="NO" @if($enquiry->ern_sample=='NO') checked @endif readonly>
                            <label class="form-check-label" for="inlineRadio2">NO</label>
                          </div>
                        @error('ern_sample')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-sm-8 col-form-label required">SIR Sample*</label>

                        <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sir_sample" id="inlineRadio3" value="YES" @if($enquiry->sir_sample=='YES') checked @endif readonly >
                            <label class="form-check-label" for="inlineRadio1">YES</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sir_sample" id="inlineRadio4" value="NO" @if($enquiry->sir_sample=='NO') checked @endif readonly >
                            <label class="form-check-label" for="inlineRadio2">NO</label>
                          </div>
                        @error('sir_sample')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-sm-8 col-form-label required">SafeLaunch Sample*</label>

                        <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="safe_launch_sample" id="inlineRadio5" value="YES"  @if($enquiry->safe_launch_sample=='YES') checked @endif  readonly>
                            <label class="form-check-label" for="inlineRadio1">YES</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="safe_launch_sample" id="inlineRadio6" value="NO" @if($enquiry->safe_launch_sample=='NO') checked @endif readonly>
                            <label class="form-check-label" for="inlineRadio2">NO</label>
                          </div>
                        @error('ern_sample')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>

                    </div>
                </div>

                  </form>
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
