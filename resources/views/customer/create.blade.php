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
    <strong>Error!</strong> {{session('error')}}
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  
    <div class="card ">
        <div class="card-header">
            Create New Customer <a href="{{route("customer.index")}}" class="btn btn-sm btn-primary float-end">Customer List</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('customer.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name" class="col-sm-4 col-form-label required">Customer Type*</label>
                          <select name="customer_type_id" id="customer_type_id" class="form-control select2">
                            <option value="">Select Customer Type</option>
                            @foreach ($customer_types as $customer_type)
                                <option value="{{$customer_type->id}}" @if (old('customer_type_id')==$customer_type->id)
                                    selected
                                @endif>{{$customer_type->name}}</option>
                            @endforeach
                          </select>
                          @error('customer_type_id')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name" class="col-sm-4 col-form-label required">Name*</label>
                          <input type="text" class="form-control" id="name" name="name" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                          @error('name')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name" class="col-sm-4 col-form-label required">Contact Person*</label>
                          <input type="text" class="form-control" id="contact_person" name="contact_person" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('contact_person') }}">
                          @error('contact_person')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name" class="col-sm-4 col-form-label required">Email Address*</label>
                          <input type="text" class="form-control" id="email" name="email" @error('email') is-invalid @enderror autocomplete="off" value="{{ old('email') }}">
                          @error('email')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
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
  $("#customer_type_id").select2();
</script>
@endpush