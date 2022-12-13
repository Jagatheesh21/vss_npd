<div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label required">Raw Materials *</label>
    <div class="col-sm-6">
        <select name="raw_material_id" id="raw_material_id"  class="form-control select2">
            <option value="">Select Raw Material</option>
            @foreach($raw_materials as $raw_material)
            <option value="{{$raw_material->id}}">{{$raw_material->name}}-{{$raw_material->part_description}}</option>
            @endforeach
        </select>
        @error('raw_material_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label required">Nestings *</label>
    <div class="col-sm-6">
        <select name="nesting_id" id="nesting_id"  class="form-control select2">
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
<script>
    $("#raw_material_id").select2({
    placeholder: "Select a Material",
    allowClear: true
   
});
$("#nesting_id").select2({
    placeholder: "Select a Nesting Type",
    allowClear: true
   
});
$("#nesting_id").change(function(){
var nesting_id = $(this).val();
    $.ajax({
        url:'{{route("getNestingSequence")}}',
        type:'POST',
        data:{nesting_id:nesting_id},
        success:function(response){
            $("#nesting_view").html(response.html);
        }
    });
});
</script>