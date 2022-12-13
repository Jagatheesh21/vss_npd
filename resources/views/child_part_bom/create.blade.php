@extends('layouts.app')
{{-- @livewireStyles --}}
@section('content')
<div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-coreui-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{session('success')}}.
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger" role="alert">
  {{session('error')}}
  <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="card">
        <div class="card-header">
            <strong>Child Part - BOM</strong> 
        </div>
        <div class="card-body">
            
            <div class="col-md-12">
                <form id="bom_save" action="{{route("child_part_bom.store")}}" method="POST">
                  @csrf
                  @method('POST')
                  {{-- @livewire('raw-material') --}}
                  <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label required">BOM *</label>
                    <div class="col-sm-6"> 
                        <input type="text" class="form-control" name="bom_id" value="{{$bom_number}}" readonly>   
                        @error('bom_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label required">Type *</label>
                    <div class="col-sm-6">          
                            <select id="type_id" name="type_id" class="form-control">
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>            
                            @error('type_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>

                <div id="raw_material_div">

                </div>
                  <div class="col-md-12" id="nesting_view">
                  </div>  
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" id="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
{{-- @livewireScripts --}}
@push('scripts')
<script src="{{asset("js/select2.min.js")}}"></script>

<script>

// $('#bom_save').validate({ // initialize the plugin
//         rules: {
//             'type_id':'required',
//             'raw_material_id':'required',
//             'nesting_id':{
//                 required:function(element) {
//                     if($("#type_id").val()==1)
//                     {
//                         return true;
//                     }else{
//                         return false;
//                     }
//                 },
//             },
//             'nesting_type_id[]':{
//                 required:function(element) {
//                     if($("#type_id").val()==1)
//                     {
//                         return true;
//                     }else{
//                         return false;
//                     }
//                 },
//             },
//                 'child_part_number_id[*]':{
//                 required:function(element) {
//                     if($("#type_id").val()==1)
//                     {
//                         return true;
//                     }else{
//                         return false;
//                     }
//                 },
//             }
//         }
//     });
// });
// $("#bom_save").submit(function(e){
//     e.preventDefault();
//     alert("Test");
//     var $form = $('#bom_save');
//     if($form.valid()){
    
//     var data = $(this).serialize();
//     $.ajax({
//         url:"{{route('child_part_bom.store')}}",
//         type:"POST",
//         data:data,
//         success:function(response){
//             alert(response);
//         },
//         error:function(response)
//         {
//             alert(response);
//         }
//     });
// }
// });
$(".child_part_number_id").select2({
    placeholder: "Select a PartNumber",
    allowClear: true
});
$("#type_id").select2({
    placeholder: "Select a Type",
    allowClear: true
   
});
$(".nesting_type_id").select2();

//Ajax call
$("#type_id").change(function(e){
e.preventDefault();
var type_id = $(this).val();
if(type_id =='' || type_id==null || type_id==undefined)
{
   alert('Please Select Type Value..');
}else{
if(type_id==1){
$.ajax({
    url:'{{route("getRawMaterials")}}',
    type:'POST',
    data:{type_id:type_id},
    success:function(response)
    {
        $("#raw_material_div").html(response.html);
    }
});
}else{
    $("#raw_material_div").html(" ");
    $("#nesting_view").html(" ");
}
}
});
</script>
@endpush