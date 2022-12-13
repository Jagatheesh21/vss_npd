<option value="">Select Nesting Type</option>
@foreach ($nesting_sequences as $nesting_sequence)
<option value="{{$nesting_sequence->nesting_type_id}}">{{$nesting_sequence->nesting_type->name}}</option>
@endforeach
