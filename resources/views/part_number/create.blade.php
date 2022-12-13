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
    A simple success alert—check it out!
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  
    <div class="card ">
        <div class="card-header">
            Create New Part Number <a href="{{route('part_number.index')}}" class="btn btn-sm btn-primary float-end">Part Number List</a>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form id="category_save" method="POST" action="{{route('part_number.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name" class="col-sm-6 col-form-label required">Name*</label>
                          <input type="text" class="form-control" id="name" name="name" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                          @error('name')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name" class="col-sm-6 col-form-label required">Description*</label>
                          <input type="text" class="form-control" id="description" name="description" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                          @error('description')
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
