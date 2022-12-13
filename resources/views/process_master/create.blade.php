@extends('layouts.app')
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
    <div class="card">
        <div class="card-header">
            Create Process Master
        </div>
        <div class="card-body justify-content-center">
            <div class="col-md-8">
              <form id="process_master_save" method="POST" action="{{route('process_master.store')}}">
                @csrf
                @method('POST')  
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label required">Child Part Number*</label>
                    <div class="col-sm-10">
                    <select name="child_part_number_id" id="child_part_number_id" class="form-control select2">
                        <option value="">Select Part Number</option>
                        @foreach($child_part_numbers as $child_part_number)
                        <option value="{{$child_part_number->id}}">{{$child_part_number->name}}</option>
                        @endforeach
                    </select>
                      @error('name') 
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                </div>  
                <div class="row">
                    <label for="">Operations*</label>
                </div>
                <div class="row">
                    
                    @foreach($operations as $operation)
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline"">
                            <input class="form-check-input" name="operation_id[{{$operation->id}}]" type="checkbox" value="yes" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              {{$operation->id}}0-{{$operation->name}} - {{$operation->type}}
                            </label>
                          </div>
                    </div>
                @endforeach
            </div>
                <button type="submit" id="submit" class="btn btn-primary btn-sm ">Save</button>                              
              </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $("#child_part_number_id").select2({
            placeholder:"Select Part Number",
            allowedClear:true,
        });
    </script>
@endpush