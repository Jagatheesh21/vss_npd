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
            <b>Product Information Data - Details</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('product_information_data.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-3 ">
                            <label for="name" class="col-sm-6 col-form-label required">Timing Plan#</label>
                            <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" class="form-control select2 bg-light" >
                                @foreach ($plans as $t_plan)
                                    @if ($t_plan->id==$productInformationData->timing_plan->id)
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
                                    @if ($part_number->id==$productInformationData->timing_plan->part_number_id)
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
                            <input type="text" name="revision_number" class="form-control bg-light" readonly value="{{$productInformationData->timing_plan->revision_number}}">
                            @error('revision_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Date*</label>
                            <input type="text" name="revision_date" class="form-control bg-light" readonly value="{{$productInformationData->timing_plan->revision_date}}">
                            @error('revision_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Customer Type*</label>
                            <select name="application" id="application" class="form-control select2 bg-light">
                                @foreach ($customer_types as $customer_type)
                                    @if ($customer_type->id==$productInformationData->timing_plan->customer->customer_type->id)
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
                                    @if ($customer->id==$productInformationData->timing_plan->customer_id)
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
                                    @if ($part_number->id==$productInformationData->timing_plan->part_number_id)
                                    <option value="{{$part_number->id}}" selected>{{$part_number->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('product_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Price Per Piece*</label>
                            <input type="text" name="price" class="form-control"  value="{{($data->price)}}" onpaste="return false;" onkeypress=" return isNumber(event)">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Volume Requirements*</label>
                            <input type="text" name="volume_requirements" value="{{($data->volume_requirements)}}" class="form-control" >
                            @error('volume_requirements')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Delivery Commencement Date*</label>
                            <input type="date" name="delivery_commencement_date" value="{{($data->delivery_commencement_date)}}" class="form-control" required>
                            @error('delivery_commencement_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Customer PO Reference*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer_po_reference"  id="inlineRadio1" value="YES" checked>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer_po_reference" id="inlineRadio2" value="NO">
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('customer_po_reference')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Special Characteristics*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="special_characteristics" id="inlineRadio1" value="YES" {{ ($data->special_characteristics=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="special_characteristics" id="inlineRadio2" value="NO" {{ ($data->special_characteristics=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('special_characteristics')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">CPK/PPK Requirements*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cpk_ppk_requirements" id="inlineRadio1" value="YES" {{ ($data->cpk_ppk_requirements=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cpk_ppk_requirements" id="inlineRadio2" value="NO" {{ ($data->cpk_ppk_requirements=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('cpk_ppk_requirements')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Customer Requirements*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer_requirements" id="inlineRadio1" value="YES" {{ ($data->customer_requirements=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer_requirements" id="inlineRadio2" value="NO" {{ ($data->customer_requirements=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('customer_requirements')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">List Of New Equipments*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="list_of_new_equipments" id="inlineRadio1" value="YES" {{ ($data->list_of_new_equipments=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="list_of_new_equipments" id="inlineRadio2" value="NO" {{ ($data->list_of_new_equipments=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('product_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Part Approval Requirement*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="part_approval_requirement" id="inlineRadio1" value="YES" {{ ($data->part_approval_requirement=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="part_approval_requirement" id="inlineRadio2" value="NO" {{ ($data->part_approval_requirement=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('product_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Proto Type Build Requirement*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="proto_type_build_requirement"  id="inlineRadio1" value="YES" {{ ($data->proto_type_build_requirement=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="proto_type_build_requirement" id="inlineRadio2" value="NO" {{ ($data->proto_type_build_requirement=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('proto_type_build_requirement')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Labeling Requirement*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="labeling_requirement" id="inlineRadio1" value="YES" {{ ($data->labeling_requirement=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="labeling_requirement" id="inlineRadio2" value="NO" {{ ($data->labeling_requirement=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('labeling_requirement')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Product Traceability Requirement*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="product_traceability_requirement" id="inlineRadio1" value="YES" {{ ($data->product_traceability_requirement=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="product_traceability_requirement" id="inlineRadio2" value="NO" {{ ($data->product_traceability_requirement=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('product_traceability_requirement')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Other Requirement*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="other_requirement" id="inlineRadio1" value="YES" {{ ($data->other_requirement=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="other_requirement" id="inlineRadio2" value="NO" {{ ($data->other_requirement=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('other_requirement')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Experience Of Previous Developement*</label>

                            <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience_of_previous_developement" id="inlineRadio1" value="YES"  {{ ($data->experience_of_previous_development=="YES")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio1">YES</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience_of_previous_developement" id="inlineRadio2" value="NO"  {{ ($data->experience_of_previous_development=="NO")? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">NO</label>
                              </div>
                            @error('proto_type_build_requirement')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Details Of Brought Out Parts*</label>
                            <textarea name="details_of_brought_out_part" id="details_of_brought_out_part" class="form-control" rows="5">{{($data->brought_out_parts)}}</textarea>
                            @error('details_of_brought_out_part')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Details Of SubContract Process*</label>
                            <textarea name="details_of_subcontract_process"  id="details_of_subcontract_process" class="form-control" rows="5">{{($data->sub_contract_process)}}</textarea>
                            @error('details_of_subcontract_process')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-12 col-form-label required">Process Flow*</label>
                            <select name="preliminary_process_flow" id="process_flow" class="form-control">
                                <option value="completed" >COMPLETED</option>
                            </select>
                            @error('preliminary_process_flow')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <a href="{{route('product_information_data.index')}}">Back</a>
                    {{-- <button type="submit" id="submit" class="btn btn-primary" >Back</button> --}}
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    // $("#apqp_timing_plan_id").select2();
    // $("#part_number_id").select2();
</script>
@endpush
