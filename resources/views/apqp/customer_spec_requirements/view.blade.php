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
           <b>Customer Specific Requirement</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
<<<<<<< HEAD
                <form id="category_save" method="POST" enctype="multipart/form-data" action="{{route('customer_requiements.store')}}">
=======
                <form id="category_save" method="POST" action="{{route('customer_requiements.store')}}">
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <input type="hidden" name="stage_id" value="1">
                        <input type="hidden" name="sub_stage_id" value="6">
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Timing Plan#</label>
                            <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" class="form-control bg-light select2">
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
                            <select name="part_number_id" id="part_number_id" class="form-control bg-light select2">
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
                            <input type="text" name="revision_number" class="form-control bg-light" readonly  value="{{$plan->revision_number}}">
                            @error('revision_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Date*</label>
                            <input type="text" name="revision_date" class="form-control bg-light" readonly  value="{{$plan->revision_date}}">
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
<<<<<<< HEAD
                        <div class="col-md-3 mb-3">
                            <label for="" class="col-sm-8 col-form-label required">File*</label>
                            <a href="{{url($location)}}/{{$specfication[0]->file}}" class="form-control btn btn-success btn-sm text-white" target="_blank">Download</a>
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Remarks*</label>
                            <textarea name="remarks" class="form-control bg-light" id="remarks" cols="30" rows="5" readonly required>{{$specfication[0]->remarks}}</textarea>
                        </div>
=======


>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="col-sm-12">Special Manufacturing Requirements*</label>
                            <textarea name="manufacturing_requirements" id="manufacturing_requirements" required class="form-control bg-light" cols="30" rows="5" readonly>{{$specfication[0]->manufacturing_requirements}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-sm-12">Special Handling Requirements*</label>
                            <textarea name="handling_requirements" id="handling_requirements" required class="form-control bg-light" cols="30" rows="5" readonly>{{$specfication[0]->handling_requirements}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-sm-12">Special Marking Requirements*</label>
                            <textarea name="marking_requirements" id="marking_requirements" required class="form-control bg-light" cols="30" rows="5" readonly>{{$specfication[0]->marking_requirements}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-sm-12">Special Packing And Preservation*</label>
                            <textarea name="packing_preservation" id="packing_preservation" required class="form-control bg-light" cols="30" rows="5" readonly>{{$specfication[0]->packing_preservation}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-sm-12">Delivery Requirements*</label>
                            <textarea name="delivery_requirements" id="delivery_requirements" required class="form-control bg-light" cols="30" rows="5" readonly>{{$specfication[0]->delivery_requirements}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-sm-12">Document Requirements*</label>
                            <textarea name="document_requirements" id="document_requirements" required class="form-control bg-light" cols="30" rows="5" readonly>{{$specfication[0]->document_requirements}}</textarea>
                        </div>
                    </div>
                    {{-- <button type="submit" id="submit" class="btn btn-primary">Save</button> --}}
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
{{-- <script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#apqp_timing_plan_id").select2();
    $("#part_number_id").select2();
</script> --}}
@endpush
