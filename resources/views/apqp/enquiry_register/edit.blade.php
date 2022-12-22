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
            <form id="category_save" method="POST" action="{{route('enquiry_register.update',$plan->id)}}">
              @csrf
              @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Customer*</label>
                        <select name="customer_id" id="customer_id" class="form-control select2" required>
                          <option value=""></option>
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
                        <select name="part_number_id" id="part_number_id" class="form-control select2" required>
                          <option value=""></option>
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
                        <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" required class="form-control select2">
                            <option value="">Select Part Number First</option>
                            @foreach($timing_plans as $timing_plan)
                                <option value="{{$timing_plan->id}}" @if ($timing_plan->id==$plan->apqp_timing_plan_id)
                                  selected
                                @endif>{{$timing_plan->apqp_timing_plan_number}}</option>
                            @endforeach
                        </select>
                      </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Supplier Name*</label>
                    <input type="text" readonly name="supplier" id="supplier" class="form-control" value="{{$plan->plan->supplier}}" readonly>
                  </div>
                  <div class="col-md-4">
                    <label for="name" class="col-sm-6 col-form-label required">Received Date*</label>
                    <input type="date" name="received_date" id="received_date" class="form-control @error('received_date') is-invalid @enderror" value="{{ old('received_date') }}">
                    @error('received_date')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
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
</script>
@endpush
