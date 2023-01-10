@extends('layouts.app')
@push('styles')

@endpush

@section('content')
<div class="row">
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
        <div class="card-header">
            Risk Analysis
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('product_information_data.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Timing Plan#</label>
                            <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" class="form-control select2">
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
                            <select name="part_number_id" id="part_number_id" class="form-control select2">
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
                            <input type="text" name="revision_number" class="form-control" value="{{$plan->revision_number}}">
                            @error('revision_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Date*</label>
                            <input type="text" name="revision_date" class="form-control" value="{{$plan->revision_date}}">
                            @error('revision_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Application*</label>
                            <select name="application" id="application" class="form-control select2">
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
                            <select name="customer_id" id="customer_id" class="form-control select2">
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
                            <select name="product_description" id="product_description" class="form-control select2">
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
                    <div class="row">
                        <table class="table table-bordered">
                            <tr>
                                <th>S.No</th>
                                <th>Type</th>
                                <th>Risks</th>
                                <th>Risk Involved</th>
                                <th>Risk Level</th>
                                <th>In case of any Medium / High Risk</th>
                            </tr>
                            <tr>
                                <td>1.1</td>
                                <td>MAN</td>
                                <td>New operator / Inspector required?</td>
                                <td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk1" id="inlineRadio1" value="YES" checked>
                                    <label class="form-check-label" for="inlineRadio1">YES</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk1" id="inlineRadio2" value="NO">
                                    <label class="form-check-label" for="inlineRadio2">NO</label>
                                  </div></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                            </tr>
                            <tr>
                                <td>1.2</td>
                                <td>MAN</td>
                                <td>Does existing operator / inspector need training?</td>
                                <td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk2" id="inlineRadio1" value="YES" checked>
                                    <label class="form-check-label" for="inlineRadio1">YES</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk2" id="inlineRadio2" value="NO">
                                    <label class="form-check-label" for="inlineRadio2">NO</label>
                                  </div></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                            </tr>

                            <tr>
                                <td>2.1</td>
                                <td>STOCK</td>
                                <td>Delivery / Product stock: Is the stock of product sufficient to support the customer.</td>
                                <td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk3" id="inlineRadio1" value="YES" checked>
                                    <label class="form-check-label" for="inlineRadio1">YES</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk3" id="inlineRadio2" value="NO">
                                    <label class="form-check-label" for="inlineRadio2">NO</label>
                                  </div></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                            </tr>
                            <tr>
                                <td>2.2</td>
                                <td>STOCK</td>
                                <td>RM Stock at RMS: Stock in RMS? Can it be used for other products? Or this need to be scraped? If to be scraped what is the cost?</td>
                                <td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk4" id="inlineRadio1" value="YES" checked>
                                    <label class="form-check-label" for="inlineRadio1">YES</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk4" id="inlineRadio2" value="NO">
                                    <label class="form-check-label" for="inlineRadio2">NO</label>
                                  </div></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                            </tr>
                            <tr>
                                <td>2.3</td>
                                <td>STOCK</td>
                                <td>Stock at sub-supplier: Stock at supplier? Is the stock at sub-supplier is sufficient to support the customer.</td>
                                <td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk5" id="inlineRadio1" value="YES" checked>
                                    <label class="form-check-label" for="inlineRadio1">YES</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="risk5" id="inlineRadio2" value="NO">
                                    <label class="form-check-label" for="inlineRadio2">NO</label>
                                  </div></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                            </tr>
                        </table>
                    </div>
                    

                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $("#apqp_timing_plan_id").select2();
    $("#part_number_id").select2();
</script>
@endpush