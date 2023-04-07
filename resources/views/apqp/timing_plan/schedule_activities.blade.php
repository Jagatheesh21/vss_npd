<table class="table table-responsive table-bordered" style="height:500px;width:800px;overflow: scroll;">
    <thead>
      <tr>
        <th class="text-center text-bold text-white bg-primary" colspan="7">Activity</th>
      </tr>
    </thead>
    <tbody>
      <tr class="text-center text-bold text-white bg-success">
        <th>Stage</th>
        <th>Activity</th>
        <th>Plan Start Date</th>
        <th>Plan End Date</th>
        <th>Responsibility</th>
        <th>Verification&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Approval&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      </tr>
       @foreach ($sub_stages as $sub_stage)
          <tr>
            <input type="hidden" name="id[]" value="{{$sub_stage->id}}">
            <input type="hidden" name="stage_id[]" value="{{$sub_stage->stage_id}}">
            <input type="hidden" name="sub_stage_id[]" value="{{$sub_stage->sub_stage_id}}">
            <td class="col-md-2">{{$sub_stage->stage->description}}</td>

              <td class="col-md-4">{{$sub_stage->sub_stage->name}}</td>
              <td class="col-md-2 text-center"><input type="date" name="plan_start_date[]" class="form-control"  required></td>
              <td class="col-md-2 text-center"><input type="date" name="plan_end_date[]" class="form-control"  required></td>
              <td class="col-md-6 text-center">

                  <select name="responsibility[]" class="form-control select2 responsibility" required>
                    <option value="">Select Responsibility</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>

              </td>
              <td class="col-md-6 text-center" >

                  <select name="verified_by[]" class="form-control select2 verification" required>
                    <option value="">Select</option>
                    @foreach ($verification_users as $verification_user)
                        <option value="{{$verification_user->id}}" selected>{{$verification_user->name}}</option>
                    @endforeach
                  </select>

              </td>
              <td class="col-md-6 text-center">
                  <select name="approved_by[]" class="form-control select2 approval" required>
                    <option value="">Select</option>
                    @foreach ($approval_users as $approval_user)
                        <option value="{{$approval_user->id}}">{{$approval_user->name}}</option>
                    @endforeach
                  </select>
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
        $(".verification").select2({
            placeholder:"Select Verification",
            allowedClear:true,
        });
        $(".approval").select2({
            placeholder:"Select Approval",
            allowedClear:true,
        });
  </script>
