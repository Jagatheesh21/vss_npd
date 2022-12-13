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
    {{session('error')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="card mb-4">
        <div class="card-header">
            <strong>Edit Customer</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <form id="category_update" method="POST" action="{{route('sub_stage.update',$subStage->id)}}">
                  @csrf
                  @method('PUT')
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name" class="col-sm-6 col-form-label required">Stage</label>
                          <select name="stage_id" id="stage_id" class="select2 form-control">
                            <option value="">Select Stage</option>
                            @foreach ($stages as $stage)
                                <option value="{{$stage->id}}" @if ($stage->id==$subStage->stage_id) selected @endif>{{$stage->name}}</option>
                            @endforeach
                          </select>
                          @error('stage_id')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name" class="col-sm-6 col-form-label required">Name*</label>
                          <input type="text" class="form-control" id="name" name="name" @error('name') is-invalid @enderror autocomplete="off" value="{{$subStage->name}}">
                          @error('name')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      
                     
                    </div>
                    

                    <button type="submit" id="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>

</script>
@endpush