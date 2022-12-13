@foreach($nesting_sequences as $key=>$child_part)
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="col-sm-6 col-form-label" for="">Nesting Type* </label>
            <select name="nesting_type_id" id="nesting_type_id" class="form-control select2">
                <option value="">Select Nesting First</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="col-sm-6 col-form-label" for="">Child Part Number* </label>
            <select name="child_part_number_id" id="child_part_number_id" class="form-control select2">
                <option value="">Select Nesting Type First</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="" class="col-sm-6 col-form-label">Quantity</label>
            <input type="text" name="quantity[]" class="form-control" >
        </div>
    </div>
</div>
@endforeach