    <div class="form-group">
      <label class="col-sm-6 col-form-label" for="">Nesting * </label>
        <select name="nesting_id" id="nesting_id" class="form-control select2">
            <option value="">Select Nesting</option>
            @foreach ($nestings as $nesting)
                <option value="{{$nesting->nesting_id}}">{{$nesting->nesting->name}}</option>
            @endforeach
        </select>
    </div>
