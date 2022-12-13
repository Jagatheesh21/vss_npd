@extends('layouts.app')
@push('styles')

@endpush

@section('content')
<div class="row">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Edit Operation</h3>
        </div>  
        <div class="card-body">
            <div class="row">
                <form id="operation_update" method="POST" action="{{route('operation.update',$operation->id)}}">
                  @csrf
                  @method('PUT')
                    <div class="row mb-3">
                      <label for="name" class="col-sm-2 col-form-label required">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{$operation->name}}">
                        
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="descrption" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <textarea name="description" id="description" class="form-control" rows="10">{!!$operation->description!!}</textarea>
                        
                      </div>
                    </div>

                    <button type="submit" id="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush