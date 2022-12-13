<option value="">Select Type</option>
@foreach ($types as $type)
<option value="{{$type->id}}" {{ old("type_id") == $type->id ? "selected" : "" }}>{{$type->name}}</option>   
@endforeach
