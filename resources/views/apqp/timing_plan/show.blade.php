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
    <strong>Error!</strong>{{session('error')}}
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="card ">
        <div class="card-header">
            Create New Timing Plan 
            <a href="{{route('apqp_timing_plan.index')}}" class="btn btn-primary btn-sm float-end">Timing Plans</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('apqp_timing_plan.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Customer*</label>
                        <select name="customer_id" id="customer_id" class="form-control select2">
                          <option value=""></option>
                          @foreach($customers as $customer)
                          <option value="{{$customer->id}}" @if (old('customer_id')==$customer->id)
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
                        <select name="part_number_id" id="part_number_id" class="form-control select2">
                          <option value=""></option>
                          @foreach($part_numbers as $part_number)
                          <option value="{{$part_number->id}}" @if (old('part_number_id')==$part_number->id)
                              selected
                          @endif>{{$part_number->name}}</option>
                          @endforeach
                        </select>
                        @error('part_number_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Revision Number*</label>
                        <input type="text" name="revision_number" id="revision_number" class="form-control @error('revision_number') is-invalid @enderror" value="{{ old('revision_number') }}">
                        @error('revision_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Revision Date*</label>
                        <input type="date" name="revision_date" id="revision_date" class="form-control @error('revision_date') is-invalid @enderror" value="{{ old('revision_date') }}">
                        @error('revision_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Issue Number*</label>
                        <input type="text" name="issuance_number" id="issuance_number" class="form-control @error('issuance_number') is-invalid @enderror" value="{{ old('issuance_number') }}">
                        @error('issuance_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-4">
                        <label for="name" class="col-sm-6 col-form-label required">Issue Date*</label>
                        <input type="date" name="issuance_date" id="issuance_date" class="form-control @error('issuance_date') is-invalid @enderror" value="{{ old('issuance_date') }}">
                        @error('issuance_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      
                    </div>
                    <div class="row mb-3 activities_view" >
                      
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
        
    </script>
@endpush