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
  <strong>Error!</strong> {{session('error')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
  
    <div class="card ">
        <div class="card-header">
            Create New Operation
        </div>
        <div class="card-body">
            <div class="col-md-8">
                <form id="operation_save" method="POST" action="{{route('operation.store')}}">
                  @csrf
                  @method('POST')
                  <div class="row mb-3">
                    <label for="name" class="col-sm-4 col-form-label required">Operation Type</label>
                    <div class="col-sm-8">
                      <select name="operation_type_id" id="operation_type_id" class="form-control select2">
                        <option value="1">Stocking Point</option>
                        <option value="2">Operation</option>
                      </select>
                      @error('operation_type_id')
                        <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    
                  </div>
                    <div class="row mb-3">
                      <label for="name" class="col-sm-4 col-form-label required">Name</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      
                    </div>
                    <div class="row mb-3">
                      <label for="descrption" class="col-sm-4 col-form-label">Description</label>
                      <div class="col-sm-8">
                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror"  >
                        @error('description')
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

@endpush