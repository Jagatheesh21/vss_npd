@extends('layouts.app')
@livewireStyles
@push('styles')

@endpush
@livewireStyles
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="card">
        <div class="card-header">
            Create Nesting
        </div>
        <div class="card-body justify-content-center">
            <div class="col-md-8">
              <form id="nesting_save" method="POST" action="{{route('nesting.store')}}">
                @csrf
                @method('POST')    
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label required">Name*</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                <button type="submit" id="submit" class="btn btn-primary btn-sm ">Save</button>                              
              </form>
            </div>
        </div>
    </div>
@endsection
@livewireScripts
