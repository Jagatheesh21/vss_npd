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
  
    <div class="card ">
        <div class="card-header">
            Create New Child Part Number
            <a href="{{route("child_part_number.index")}}" class="btn btn-primary btn-sm float-end">Child Part Number List</a>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form id="child_part_number_save" method="POST" action="{{route('child_part_number.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <label for="name" class="col-sm-2 col-form-label required">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="name" class="col-sm-2 col-form-label required">Description</label>
                      <div class="col-sm-10">
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="2">{{ old('description') }}</textarea>
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
