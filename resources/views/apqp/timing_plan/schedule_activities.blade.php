<table class="table table-responsive table-bordered" style="height:500px;overflow-y: scroll;">
    <thead>
      <tr>
        <th class="text-center text-bold text-white bg-primary" colspan="3">Activity</th>
      </tr>
    </thead> 
    <tbody>
      <tr class="text-center text-bold text-white bg-success">
        <th>Activity</th>
        <th>Process Time</th>
        <th>Responsibility</th>
      </tr>
      @foreach ($sub_stages as $sub_stage)
          <tr>
            <input type="hidden" name="stage_id[]" value="{{$sub_stage->stage_id}}">
            <td class="col-md-6">{{$sub_stage->name}}
              <input type="hidden" name="activity_id[]" value="{{$sub_stage->id}}">
              <input type="hidden" name="sub_stage_id[]" value="{{$sub_stage->sub_stage_id}}">
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