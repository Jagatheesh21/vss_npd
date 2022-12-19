<table class="table table-responsive table-bordered" style="width:500px;overflow-y: scroll;">
    <thead>
      <tr>
        <th class="text-center text-bold text-white bg-primary" colspan="3">Activity</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($stages as $stage)
      <tr>
        <input type="hidden" name="stage_id[]" value="{{$stage->stage_id}}">
          <td class="text-center text-bold text-white bg-info" colspan="3">{{$stage->stage->description}} - {{$stage->stage->name}}
            <tr class="text-center text-bold text-white bg-success">
              <th>Activity</th>
              <th>Process Time</th>
              <th>Responsibility</th>
            </tr>
            @foreach ($stage->stage->sub_stages as $sub_stage)
            <tr>
              <td class="col-md-6">{{$sub_stage->name}}
              <input type="hidden" name="sub_stage_id[]" value="{{$sub_stage->id}}">
              </td>
              <td class="col-md-2">
                <input type="number" class="form-control" name="process_time[]"  value="1" min="1">
              </td>
              <td class="col-md-4">
                <select name="responsibility[]" class="form-control select2 responsibility">
                  <option value="">Select User</option>
                  @foreach ($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
              </td>
            </tr> 
            @endforeach
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <script src="{{asset('js/select2.min.js')}}"></script>
  <script>
    $(".responsibility").select2({
            placeholder:"Select Responsibility",
            allowedClear:true,
        });
  </script>