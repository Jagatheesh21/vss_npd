@foreach($part_masters as $part_master)
        <option value="">Select Child Part Number</option>
        <option value="{{$part_master->child_part->id}}">{{$part_master->child_part->name}}</option>
@endforeach
