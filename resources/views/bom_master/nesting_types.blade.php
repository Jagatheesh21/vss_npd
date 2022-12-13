    @foreach($nesting_types as $nesting_type)
    <div class="row mb-3 item_row" data-id="{{$loop->iteration}}">
        <table>
            <div class="col-sm-4">
                <label for="">Nesting Type</label>
                <select name="nesting_type_id[]" class="form-control select2 nesting_type_id" id="nesting_type_id_{{$loop->iteration}}"  data-id="{{$loop->iteration}}">
                    <option value="">Select Type</option>
                    @foreach($types as $type)
                    @if($type->id==$nesting_type->type_id)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endif
                    @endforeach
                </select>
                @error('nesting_type_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-sm-4 child_part_number" >
                <label for="">Child Part Number</label>
                <select name="child_part_number_id[]" id="child_part_number_id_{{$loop->iteration}}" class="form-control select2 child_part_number_id" data-id="{{$loop->iteration}}"> required>
                    <option value="">Select Child Part</option>
                   
                </select>
                
            </div>
            <div class="col-sm-4 quantity">
                <label for="">Quantity</label>
                <input type="text" class="form-control" name="quantity[]">
                @error('quantity')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </table>
    </div>
    @endforeach
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $('.nesting_type_id').select2({
        placeholder: "Select Type",
        allowClear: true
    });
    $('.child_part_number_id').select2({
        placeholder: "Select Child Part",
        allowClear: true
    });
 
    $('body').on('change','.nesting_type_id',function(e){
    e.preventDefault();
    var nesting_type_id = $(this).val();
    var row_id = $(this).closest(".item_row").data("id");
    
    if(nesting_type_id!='')
    {
    //alert(nesting_type_id);
    $.ajax({
        url:'{{route("getChildPartnumber")}}',
        type:'POST',
        data:{nesting_type_id:nesting_type_id},
        success:function(response){
            $("#child_part_number_id_"+row_id).html(response.html);
            $("#child_part_number_id_"+row_id).select2({
    placeholder: "Select a Child Part number",
    allowClear: true
   
});
            // $(this).closest(".item_row").next().find(".child_part_number_id").html(response.html);
            // $(this).closest('#nesting_view').find(".child_part_number").html(response.html);
        }
    });
    }
});
</script>