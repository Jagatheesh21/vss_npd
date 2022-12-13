@extends('layouts.app')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
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
            Create New Type
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form id="type_save" method="POST" action="{{route('type.store')}}">
                  @csrf
                  @method('POST')
                  <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label required">Category Name</label>
                    <div class="col-sm-10">
                      <select name="category_id" id="category-id" class="select2 form-control">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                      @error('category_id')
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
                    

                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $("#category_id").select2({
    placeholder: "Select a category"
});
</script>
@endpush