@foreach ($child_part_numbers as $part_number)
    <option value="{{$part_number->id}}">{{$part_number->child_part_number->name}}</option>
@endforeach