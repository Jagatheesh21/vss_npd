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
            Create New Supplier 
            <a href="{{route('supplier.index')}}" class="btn btn-primary float-end">Supplier List</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('supplier.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="name" class="col-sm-2 col-form-label required">Name*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-6 col-form-label required">Company Name*</label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name"  autocomplete="off" value="{{ old('company_name') }}">
                        @error('company_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-2 col-form-label required">GST Number*</label>
                        <input type="text" class="form-control @error('gst_number') is-invalid @enderror" minlength="15" maxlength="15" id="gst_number" name="gst_number"  autocomplete="off" value="{{ old('gst_number') }}">
                        @error('gst_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-4 col-form-label required">Mobile Number*</label>
                        <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" minlength="10" maxlength="10"  id="mobile_number" name="mobile_number"  autocomplete="off" value="{{ old('mobile_number') }}">
                        @error('mobile_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-4 col-form-label required">Contact Number*</label>
                        <input type="text" class="form-control @error('contact_number') is-invalid @enderror" minlength="10" maxlength="15" id="contact_number" name="contact_number"  autocomplete="off" value="{{ old('contact_number') }}">
                        @error('contact_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-4 col-form-label required">HSN Code*</label>
                        <input type="text" class="form-control @error('hsn_code') is-invalid @enderror" id="hsn_code" name="hsn_code"  autocomplete="off" value="{{ old('hsn_code') }}">
                        @error('hsn_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="name" class="col-sm-4 col-form-label required">Contact Person*</label>
                        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person"  autocomplete="off" value="{{ old('contact_person') }}">
                        @error('contact_person')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-6"> 
                        <label for="vendor_code" class="col-sm-4 col-form-label required">Vendor Code</label>
                        <input type="text" class="form-control @error('vendor_code') is-invalid @enderror" id="vendor_code" name="vendor_code"  autocomplete="off" value="{{ old('vendor_code') }}">
                        @error('vendor_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-md-12">
                        <label for="name" class="col-sm-2 col-form-label required">Address*</label>
                        <textarea name="address" id="address" cols="20" rows="5" class="form-control @error('address') is-invalid @enderror"></textarea>
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
  // $("#category_save").submit(function(event){
  //   event.preventDefault();
  //   var data = $(this).serialize();
    
  //   $.ajax({
  //     url:'{{route('supplier.store')}}',
  //     type:'POST',
  //     data:data,
  //     success:function(response){
  //       console.log(response);
  //     }
  //   });
  // })
</script>
@endpush