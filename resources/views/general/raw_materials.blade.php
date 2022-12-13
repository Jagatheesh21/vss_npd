<option value="">Select Material</option>
@foreach($materials as $raw_material)
<option value="{{$raw_material->id}}" {{ old("raw_material_id") == $raw_material->id ? "selected" : "" }}>{{$raw_material->name}}-{{$raw_material->part_description}}</option>
@endforeach
