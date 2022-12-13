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
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('error')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="card mb-4">
        <div class="card-header">
            <strong>Edit Supplier</strong>
        </div>
        <div class="card-body">
          <div class="col-md-12">
              <form id="category_save" method="POST" action="{{route('supplier.update',$supplier->id)}}">
                @csrf
                @method('PUT')
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="name" class="col-sm-2 col-form-label required">Name*</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  autocomplete="off" value="{{ $supplier->name }}">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="col-sm-6 col-form-label required">Company Name*</label>
                      <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name"  autocomplete="off" value="{{ $supplier->company_name }}">
                      @error('company_name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="col-sm-2 col-form-label required">GST Number*</label>
                      <input type="text" class="form-control @error('gst_number') is-invalid @enderror" id="gst_number" name="gst_number"  autocomplete="off" value="{{ $supplier->gst_number }}">
                      @error('gst_number')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="col-sm-4 col-form-label required">Mobile Number*</label>
                      <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number"  autocomplete="off" value="{{ $supplier->mobile_number }}">
                      @error('mobile_number')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="col-sm-4 col-form-label required">Contact Number*</label>
                      <input type="text" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number"  autocomplete="off" value="{{ $supplier->contact_number }}">
                      @error('contact_number')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="col-sm-4 col-form-label required">HSN Code*</label>
                      <input type="text" class="form-control @error('hsn_code') is-invalid @enderror" id="hsn_code" name="hsn_code"  autocomplete="off" value="{{ $supplier->hsn_code }}">
                      @error('hsn_code')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="col-sm-4 col-form-label required">Contact Person*</label>
                      <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person"  autocomplete="off" value="{{ $supplier->contact_person }}">
                      @error('contact_person')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-6"> 
                      <label for="vendor_code" class="col-sm-4 col-form-label required">Vendor Code</label>
                      <input type="text" class="form-control @error('vendor_code') is-invalid @enderror" id="vendor_code" name="vendor_code"  autocomplete="off" value="{{ $supplier->vendor_code }}">
                      @error('vendor_code')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="name" class="col-sm-2 col-form-label required">Address*</label>
                      <textarea name="address" id="address" cols="20" rows="5" class="form-control @error('address') is-invalid @enderror">{!!$supplier->address!!}</textarea>
                      @error('address')
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
<script>

</script>
@endpush