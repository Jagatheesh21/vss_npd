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
            Create Part Master
        </div>
        <div class="card-body justify-content-center">
            <div class="col-md-8">
              <form wire:submit.prevent="storePartMaster" id="part_master_save" method="POST" action="{{route('part_master.store')}}">
                @csrf
                @method('POST')    
                  @livewire('parent-child')
                <button type="submit" id="submit" class="btn btn-primary btn-sm ">Save</button>                              
              </form>
            </div>
        </div>
    </div>
@endsection
@livewireScripts
@push('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('.select2').select2();
        });
    });
</script>
{{-- <script>
    $("#operation_save").submit(function(e){
      e.preventDefault();
      
      var url = "{{route('operation.store')}}";
      $.ajax({
        url:url,
        type:"POST",
        data:$(this).serialize(),
        dataType: "json",
        success: function(data) {
          Swal.fire({
  title: 'success!',
  text: data.message,
  icon: 'success',
})
        },
        error: function(response) {
            $.each(response.responseJSON.errors, function(index, value) {
              $("#"+index+"_error").html(+value+);
            });
        }
      });
    }); 
</script> --}}
@endpush