@extends('layouts.app')
@section('content')
    
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="card">
        <div class="card-header">
            Create Nesting Sequence
        </div>
        <div class="card-body justify-content-center">
            <div class="col-md-8">
              <form id="nesting_sequence_save" method="POST" action="{{route('nesting_sequence.store')}}">
                @csrf
                @method('POST') 
                <div class="row mb-3">
                  <label for="type" class="col-sm-2 col-form-label required">Nesting*</label>
                  <div class="col-sm-8">
                    <select name="nesting_id" id="nesting_id" class="form-control select2">
                      <option value="">Select Nesting</option>
                      @foreach($nestings as $nesting)
                      <option value="{{$nesting->id}}">{{$nesting->name}}</option>
                      @endforeach
                    </select>
                    @error('nesting_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>   
                <div class="row mb-3">
                    <label for="type" class="col-sm-2 col-form-label required">Type*</label>
                    <div class="col-sm-8">
                      <select name="type_id[]" id="type_id" class="form-control select2" multiple>
                        @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                      </select>
                      @error('type_id')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
    
                  </div>

                  <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                <button type="submit" id="submit" class="btn btn-primary btn-sm ">Save</button>
                    </div>
                  </div>                              
              </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script type="text/javascript">
$("#nesting_id").select2();
$("#type_id").select2();
</script>
@endpush