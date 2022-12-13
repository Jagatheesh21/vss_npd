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
            Create New Material
        </div>
        <div class="card-body">
            <div class="col-md-8">
                <form id="operation_save" method="POST" action="{{route('raw_material.store')}}">
                  @csrf
                  @method('POST')
                  <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label required">Material Type</label>
                    <div class="col-sm-10">
                        <select name="type_id" id="type_id" class="form-control">
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    
                  </div>

                    <div class="row mb-3">
                      <label for="name" class="col-sm-2 col-form-label required">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      
                    </div>
                    <div class="row mb-3">
                      <label for="name" class="col-sm-2 col-form-label required">Part Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="part_description" name="part_description" @error('part_description') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                        @error('part_description')
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