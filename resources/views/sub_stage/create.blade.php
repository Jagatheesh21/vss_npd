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
            Create New Sub Stage <a href="{{route('sub_stage.index')}}" class="btn btn-sm btn-primary float-end">SubStage List</a>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form id="category_save" method="POST" action="{{route('sub_stage.store')}}">
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name" class="col-sm-6 col-form-label required">Stage*</label>
                          <select name="stage_id" id="stage_id" class="form-control select2">
                            <option value="">Select Stage</option>
                            @foreach ($stages as $stage)
                            <option value="{{$stage->id}}">{{$stage->name}}</option>
                            @endforeach
                          </select>
                          @error('name')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name" class="col-sm-6 col-form-label required">Name*</label>
                          <input type="text" class="form-control" id="name" name="name" @error('name') is-invalid @enderror autocomplete="off" value="{{ old('name') }}">
                          @error('name')
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
$("#stage_id").select2({
  placeholder:"Select Stage",
  allowedClear:true
});
</script>    
@endpush