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
            <strong>Edit Stocking Point</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <form id="stocking_point_update" method="POST" action="{{route('stocking_points.update',$stocking_point->id)}}">
                  @csrf
                  @method('PUT')
                    <div class="row mb-3">
                      <label for="name" class="col-sm-2 col-form-label required">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{$stocking_point->name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="descrption" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <textarea name="description" id="description" class="form-control" rows="10">{!!$stocking_point->description!!}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
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