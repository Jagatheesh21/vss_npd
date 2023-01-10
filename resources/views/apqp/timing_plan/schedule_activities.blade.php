<table class="table table-responsive table-bordered" style="height:500px;overflow-y: scroll;">
    <thead>
      <tr>
        <th class="text-center text-bold text-white bg-primary" colspan="4">Activity</th>
      </tr>
    </thead> 
    <tbody>
      <tr class="text-center text-bold text-white bg-success">
        <th>Stage</th>
        <th>Activity</th>
        <th>Process Time</th>
        <th>Responsibility</th>
      </tr> 
       @foreach ($sub_stages as $sub_stage)
          <tr>
            <input type="hidden" name="id[]" value="{{$sub_stage->id}}">
            <input type="hidden" name="stage_id[]" value="{{$sub_stage->stage_id}}">
            <input type="hidden" name="sub_stage_id[]" value="{{$sub_stage->sub_stage_id}}">
            <td class="col-md-2">{{$sub_stage->stage->description}}</td>
            
              <td class="col-md-4">{{$sub_stage->sub_stage->name}}</td>
              <td class="col-md-2 text-center"><input type="text" name="process_time[]" class="form-control" value="1" min="1" required></td>
              <td>
                <div class="col-md-6 text-center">
                  <select name="responsibility[]" class="form-control select2 responsibility" required>
                    <option value="">Select Responsibility</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
                
              </td>
            </tr>
      @endforeach
      {{-- @foreach ($stages as $stage)
          <tr>
            <td>{{$stage->stage->description}}-{{$stage->stage->name}}
            @foreach ($stage->sub_stages as $sub_stage)
            <tr>
              <td>{{$sub_stage->name}}</td>
            </tr>  
            @endforeach    
            </td>
          </tr>
      @endforeach --}}


    </tbody>
  </table>
  <script src="{{asset('js/select2.min.js')}}"></script>
  <script>
    $(".responsibility").select2({
            placeholder:"Select Responsibility",
            allowedClear:true,
        });
  </script>