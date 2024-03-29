@extends('layouts.app')
@push('styles')

@endpush

@section('content')

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{session('success')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger" role="alert">
    <strong>Error!</strong> {{session('error')}}.
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <div class="card">
        <div class="card-header text-center">
            <b>Management Review Meeting</b>
        </div>
        <div class="card-body">
            <div class="col-md-12">
<<<<<<< HEAD
                <form id="category_save" method="POST"  enctype="multipart/form-data" action="{{route('management_review.store')}}">
=======
                <form id="category_save" method="POST" action="{{route('management_review.store')}}">
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                  @csrf
                  @method('POST')
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name" class="col-sm-6 col-form-label required">Timing Plan#</label>
                            <select name="apqp_timing_plan_id" id="apqp_timing_plan_id" class="form-control select2 bg-light">
                                @foreach ($plans as $t_plan)
                                    @if ($t_plan->id==$plan->id)
                                    <option value="{{$t_plan->id}}" selected>{{$t_plan->apqp_timing_plan_number}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('apqp_timing_plan_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Part Number*</label>
                            <select name="part_number_id" id="part_number_id" class="form-control select2 bg-light">
                                @foreach ($part_numbers as $part_number)
                                    @if ($part_number->id==$plan->part_number_id)
                                    <option value="{{$part_number->id}}" selected>{{$part_number->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('part_number_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Number*</label>
                            <input type="text" name="revision_number" class="form-control bg-light" readonly value="{{$plan->revision_number}}">
                            @error('revision_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Revision Date*</label>
                            <input type="text" name="revision_date" class="form-control bg-light" readonly value="{{$plan->revision_date}}">
                            @error('revision_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Cusotmer Type*</label>
                            <select name="application" id="application" class="form-control select2 bg-light">
                                @foreach ($customer_types as $customer_type)
                                    @if ($customer_type->id==$plan->customer->customer_type->id)
                                    <option value="{{$customer_type->id}}" selected>{{$customer_type->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('application')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="" class="col-sm-6 col-form-label required">Customer*</label>
                            <select name="customer_id" id="customer_id" class="form-control select2 bg-light">
                                @foreach ($customers as $customer)
                                    @if ($customer->id==$plan->customer_id)
                                    <option value="{{$customer->id}}" selected>{{$customer->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('customer_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Product Description*</label>
                            <select name="product_description" id="product_description" class="form-control select2 bg-light">
                                @foreach ($part_numbers as $part_number)
                                    @if ($part_number->id==$plan->part_number_id)
                                    <option value="{{$part_number->id}}" selected>{{$part_number->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('product_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Meeting *</label>
                            <select name="meeting_number" id="meeting_number" class="form-control select2 bg-light">
<<<<<<< HEAD
                                @if($management_review_data[0]->meeting_id==1)
                                <option value="1"  selected >Meeting Review - 1</option>
                                @endif
                                @if($management_review_data[0]->meeting_id==2)
                                <option value="2"  selected >Meeting Review - 2</option>
                                @endif
                                @if($management_review_data[0]->meeting_id==3)
                                <option value="3"  selected >Meeting Review - 3</option>
                                @endif
                                @if($management_review_data[0]->meeting_id==4)
=======
                                @if($meeting_id==1)
                                <option value="1"  selected >Meeting Review - 1</option>
                                @endif
                                @if($meeting_id==2)
                                <option value="2"  selected >Meeting Review - 2</option>
                                @endif
                                @if($meeting_id==3)
                                <option value="3"  selected >Meeting Review - 3</option>
                                @endif
                                @if($meeting_id==4)
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                <option value="4"  selected >Meeting Review - 4</option>
                                @endif
                            </select>
                            @error('meeting_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Meeting Date *</label>
<<<<<<< HEAD
                            <input type="date" name="meeting_date" id="meeting_date" class="form-control bg-light" readonly value="{{$management_review_data[0]->meeting_date}}">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Meeting Attend By*</label>
                            <select name="meeting_attend_by[]" id="meeting_attend_by" multiple class="form-control select2 bg-light">
                                <option value="{{$management_review_data[0]->meeting_attend_by='msv'}}" selected>Mr.M.S. Vijayraghavan</option>
                                <option value="{{$management_review_data[0]->meeting_attend_by='msa'}}" selected>Mr.M.S. Anandakrishna</option>
                            </select>
=======
                            <input type="date" name="meeting_date" id="meeting_date" class="form-control" value="{{ $management_reviews[0]->meeting_date }}">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">Meeting Attend By*</label>
                            {{-- <select name="meeting_attend_by[]" id="meeting_attend_by" multiple class="form-control select2 bg-light">
                                @foreach ($management_reviews as $member)
                               <option value="msv" {{($member->meeting_attend_by== "msv") ? "selected" : ""}} >Mr.M.S. Vijayraghavan</option>
                               <option value="msa" {{($member->meeting_attend_by== "msa") ? "selected" : ""}} >Mr.M.S. Anandakrishnan</option>
                                <option value="msv,msa" {{ ($member->meeting_attend_by == "msv,msa")? "selected" : "" }} >Mr.M.S. Vijayraghavan &nbsp; Mr.M.S. Anandakrishnan</option>
                               @endforeach
                            </select> --}}
                            <input name="meeting_attend_by" class="form-control" value="{{($management_reviews[0]->meeting_attend_by)}}"
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                            @error('meeting_attend_by')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
<<<<<<< HEAD
                        <div class="col-md-3">
                            <label for="" class="col-sm-8 col-form-label required">File*</label>
                            <a href="{{url($location)}}/{{$management_review_data[0]->file}}" class="form-control btn btn-success btn-sm text-white" target="_blank">Download</a>
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
=======
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026

                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12" style="overflow-x:auto">
                            <table class="table table-responsive table-bordered" id="tab_logic">
                                <thead>
                                <tr class="text-center bg-light">
<<<<<<< HEAD
                                    <th>S .No</th>
                                    <th>Point Discussed</th>
                                    <th>Responsibility</th>
=======
                                    <th>Point Discussed</th>
                                    <th>Resp</th>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                    <th>Target Date</th>
                                    <th>Actual Date</th>
                                    <th>Reason For Delay</th>
                                    <th>Action Plan</th>
                                    <th>Revisied Date</th>
                                    <th>Review Comments</th>
                                </tr>
                                </thead>
                                <tbody>
<<<<<<< HEAD
                                    @forelse($management_review_data as $management_review)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
=======
                                    @forelse($management_reviews as $review_sub_stage)

                                    <tr>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                        <td>
                                            <div style="width:250px">
                                            <select name="point_discuessed[]" class="form-control bg-light">
                                            @foreach ($sub_stages as $sub_stage)
<<<<<<< HEAD
                                                @if($sub_stage->id==$management_review->points_discussed)
=======
                                                @if($sub_stage->id==$review_sub_stage->sub_stage_id)
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                                <option value="{{ $sub_stage->id }}" selected>{{ $sub_stage->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            </div>
                                        </td>
                                        <td >
                                            <div style="width:150px">
                                            <select name="responsibility[]" class="form-control bg-light">
                                                @foreach ($users as $user)
<<<<<<< HEAD
                                                    @if ($user->id==$management_review->responsibility)
=======
                                                    @if ($user->id==$review_sub_stage->responsibility)
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            </div>
                                        </td>
                                        <td>
<<<<<<< HEAD
                                            <input type="date" name="target_date[]" readonly class="form-control bg-light" value="{{ $management_review->target_date }}">
                                        </td>
                                        <td>
                                            <input type="date" name="actual_date[]" readonly class="form-control bg-light" value="{{ $management_review->actual_date }}">
                                        </td>
                                        <td>
                                            <div style="width:200px;">
                                                <textarea name="delay_reason[]" class="form-control bg-light" readonly cols="30" rows="5">{{ $management_review->delay_reason }}</textarea>
=======
                                            <input type="date" name="target_date[]" readonly class="form-control bg-light" value="{{ $review_sub_stage->target_date }}">
                                        </td>
                                        <td>
                                            <input type="date" name="actual_date[]" readonly class="form-control bg-light" value="{{ $review_sub_stage->actual_date }}">
                                        </td>
                                        <td>
                                            <div style="width:200px;">
                                                <textarea name="delay_reason[]" class="form-control" cols="30" rows="5">{{ $review_sub_stage->delay_reason }}</textarea>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                            </div>
                                        </td>
                                        <td>
                                            <div style="width:200px">
<<<<<<< HEAD
                                                <textarea name="action_plan[]" class="form-control bg-light" readonly cols="30" rows="5">{{ $management_review->action_plan }}</textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="date" name="revisied_target_date[]" class="form-control bg-light" readonly value="{{ $management_review->revisied_target_date }}">
                                        </td>
                                        <td>
                                            <div style="width:200px">
                                                <textarea name="review_comments[]" class="form-control bg-light" readonly cols="30" rows="5">{{ $management_review->review_comments }}</textarea>
=======
                                                <textarea name="action_plan[]" class="form-control" cols="30" rows="5">{{ $review_sub_stage->action_plan }}</textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="date" name="revisied_target_date[]" class="form-control" value="{{ $review_sub_stage->revisied_target_date }}">
                                        </td>
                                        <td>
                                            <div style="width:200px">
                                                <textarea name="review_comments[]" class="form-control" cols="30" rows="5">{{ $review_sub_stage->review_comments }}</textarea>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                            </div>
                                        </td>

                                    </tr>
<<<<<<< HEAD
                                    @empty
=======

                                    @empty
                                    <tr>
                                        <td>No Activity Found!</td>
                                    </tr>

>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
<<<<<<< HEAD
=======

                      <div class="row mb-3 clearfix">
                      <div class="col-md-12 text-center m-3 ">
                            <button type="button" id="submit" class="btn btn-primary align-center" onclick="confirm('Are you sure?')">Save</button>
                      </div>
                      </div>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<<<<<<< HEAD
=======
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    // $("#apqp_timing_plan_id").select2();
    // $("#part_number_id").select2();
    $("#meeting_attend_by").select2();

    // On Submit
    $("#submit").click(function(e){
        e.preventDefault();
<<<<<<< HEAD
        var formData = new FormData($("#category_save")[0]);
        $.ajax({
            url:"{{ route('management_review.store') }}",
            type:"POST",
            data: formData,
            processData: false,
            contentType: false,
            success:function(response)
            {
                console.log(response);
            //     var result = $.parseJSON(response);
                var url = "{{route('activity.index')}}";
            //     $.toast({
            //       heading: 'Success',
            //       text: response.message,
            //       showHideTransition: 'plain',
            //       position: 'top-right',
            //       icon: 'success'
            //   });
               window.location.href=url;
=======
        $.ajax({
            url:"{{ route('management_review.store') }}",
            type:"POST",
            data:$("#category_save").serialize(),
            success:function(response)
            {

                var result = $.parseJSON(response);
                $.toast({
                  heading: 'Success',
                  text: response.message,
                  showHideTransition: 'plain',
                  position: 'top-right',
                  icon: 'success'
              });
              location.reload();
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
            },
            error:function(response)
            {
                //console.log(response);
                var result = $.parseJSON(response.responseText);
                $.each(result.errors, function(key, val) {
                $.toast({
                    heading: 'Error',
                    text: val,
                    showHideTransition: 'plain',
                    position: 'top-right',
                    icon: 'error'
                })
                })
            }
        });

    });
    var i=1;
    $("#add_row").click(function(){b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++;
  	});
      $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
	});
</script>
@endpush
