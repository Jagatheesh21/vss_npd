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
            <b>Safe Launch</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="quote_save" method="POST" enctype="multipart/form-data" action="{{route('safe_launch.store')}}" >
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <input type="hidden" name="stage_id" value="4">
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
                            <select name="part_number_id" id="part_number_id" class="form-control bg-light">
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
                            <label for="" class="col-sm-6 col-form-label required">Safe Launch*</label>
                            <select name="safe_launch_id" id="safe_launch_id" class="form-control bg-light select2">
                                @if ($safe_launch_id==31)
                                <option value="1"  selected   readonly>Safe Launch 1</option>
                                @endif
                                @if ($safe_launch_id==32)
                                <option value="2"  selected   readonly>Safe Launch 2</option>
                                @endif
                                @if ($safe_launch_id==33)
                                <option value="3"  selected   readonly>Safe Launch 3</option>
                                @endif
                                @if ($safe_launch_id==34)
                                <option value="4"  selected   readonly>Safe Launch Sign Off</option>
                                @endif
                            </select>
                            @error('safe_launch_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Sub Stage*</label>
                            <select name="sub_stage_id" id="sub_stage_id" class="form-control bg-light select2">
                                @if ($safe_launch_id==31)
                                <option value="31"  selected  readonly >Safe Launch 1</option>
                                @endif
                                @if ($safe_launch_id==32)
                                <option value="32"  selected  readonly >Safe Launch 2</option>
                                @endif
                                @if ($safe_launch_id==33)
                                <option value="33"  selected  readonly >Safe Launch 3</option>
                                @endif
                                @if ($safe_launch_id==34)
                                <option value="34"  selected  readonly >Safe Launch Sign Off</option>
                                @endif
                            </select>
                            @error('sub_stage_id')
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
                            <label for="" class="col-sm-8 col-form-label required">File*</label>
                            <a href="{{url($location)}}/{{$safe_launch_data[0]->file}}" class="form-control btn btn-success btn-sm text-white" target="_blank">Download</a>
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-sm-8 col-form-label required">Remarks*</label>
                            <textarea name="remarks" class="form-control bg-light" id="remarks" cols="30" rows="5" readonly required>{{$safe_launch_data[0]->remarks}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3 clearfix">
                        <div class="col-md-12 text-center m-3 ">
                            <button type="submit" id="submit" class="btn btn-primary align-center" onclick="confirm('Are you sure?')">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

