<?php

namespace App\Http\Controllers;

use App\Models\ManagementReview;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\ActivityMail;
use Mail;
use Auth;
use App\Http\Requests\StoreManagementReviewRequest;
use App\Http\Requests\UpdateManagementReviewRequest;

class ManagementReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $meeting_id = $request->meeting_id;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $sub_stages = SubStage::get();
        if($meeting_id==1)
        {
            $stage_id = 1;
            $sub_stage_id = 10;
        }
        if($meeting_id==2)
        {
            $stage_id = 2;
            $sub_stage_id = 20;
        }
        if($meeting_id==3)
        {
            $stage_id = 3;
            $sub_stage_id = 29;
        }
        if($meeting_id==4)
        {
            $stage_id = 4;
            $sub_stage_id = 35;
        }
        $users = User::get();
        $last_id = APQPPlanActivity::where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->max('sub_stage_id');
        $review_sub_stages = APQPPlanActivity::with('sub_stage')->where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->whereNotIn('sub_stage_id',array($last_id))->get();
        return view('apqp.management_review.create',compact('plan','plans','part_numbers','customers','customer_types','meeting_id','sub_stages','review_sub_stages','users','stage_id','sub_stage_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreManagementReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManagementReviewRequest $request)
    {
        DB::beginTransaction();
        try {
            $stage_id = $request->stage_id;
            $sub_stage_id = $request->sub_stage_id;
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');
            $meeting_date = $request->input('meeting_date');
            $meeting_number = $request->input('meeting_number');
            $meeting_attend_by = json_encode($request->input('meeting_attend_by'));
            $points = $request->input('point_discuessed');
            $responsibility = $request->input('responsibility');
            $target_date = $request->input('target_date');
            $actual_date = $request->input('actual_date');
            $delay_reason = $request->input('delay_reason');
            $action_plan = $request->input('action_plan');
            $revisied_target_date = $request->input('revisied_target_date');
            $review_comments = $request->input('review_comments');
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',$stage_id)->where('sub_stage_id',$sub_stage_id)->first();

            if ($sub_stage_id==10) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/management_review1';
                // dd($location);
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
            }elseif ($sub_stage_id==20) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/management_review2';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
            }elseif ($sub_stage_id==29) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/management_review3';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
            }elseif ($sub_stage_id==35) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/management_review4';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
            }
            $file->move($location,$fileName);
            foreach($action_plan as $key=>$plan)
            {
                $management = new ManagementReview;
                $management->stage_id = $stage_id;
                $management->sub_stage_id = $sub_stage_id;
                $management->apqp_timing_plan_id = $apqp_timing_plan_id;
                $management->part_number_id = $part_number_id;
                $management->revision_number = $revision_number;
                $management->revision_date = $revision_date;
                $management->application = $application;
                $management->customer_id = $customer_id;
                $management->product_description = $product_description;
                $management->meeting_date = $meeting_date;
                $management->meeting_id = $meeting_number;
                $management->meeting_attend_by = $meeting_attend_by;
                $management->points_discussed = $points[$key];
                $management->responsibility = $responsibility[$key];
                $management->target_date = $target_date[$key];
                $management->actual_date = $actual_date[$key]??NULL;
                $management->delay_reason = $delay_reason[$key];
                $management->action_plan = $plan;
                $management->revisied_target_date = $revisied_target_date[$key];
                $management->review_comments = $review_comments[$key];
                $management->file = $fileName;
                $management->prepared_by = auth()->user()->id;
                $management->save();
            }
<<<<<<< HEAD


            //   Update Timing Plan Current Activity
              $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
              $plan->current_stage_id = $request->stage_id;
              $plan->current_sub_stage_id = $request->sub_stage_id;
              $plan->status_id = 2;
              $plan->update();
              // Update Activity
              $plan_activity->actual_start_date = Carbon::now();
              $plan_activity->prepared_by = auth()->user()->id;
              $plan_activity->prepared_at = Carbon::now();
              $plan_activity->status_id = 2;
              $plan_activity->gyr_status = "Y";
              $plan_activity->update();

            //   Mail Function
              $activity = APQPPlanActivity::find($plan_activity->id);
              $user_email = auth()->user()->email;
              $user_name = auth()->user()->name;
              Mail::to('r.naveen@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            //   Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
              DB::commit();
            //   return back()->withSuccess('Safe Launch Created Successfully!');
=======
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
<<<<<<< HEAD
            $plan->current_stage_id = 1;
            $plan->current_sub_stage_id = 10;
            $plan->status_id = 2;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',2)->first();
            $plan_activity->status_id = 2;
            $plan_activity->actual_start_date = date('Y-m-d');
            $plan_activity->prepared_date = date('Y-m-d');
            $plan_activity->update();
            //
            // $activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->first();
            // $user_email = auth()->user()->email;
            // $user_name = auth()->user()->name;
            // // Mail Function
            // //$ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            // $ccEmails = ["edp@venkateswarasteels.com"];
            // Mail::to('edp@venkateswarasteels.com')
            // ->cc($ccEmails)
            // ->send(new ActivityMail($user_email,$user_name,$activity));
            DB::commit();
            return back()->withSuccess('Management Review Created Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withError($th->getMessage());
=======
            $plan->current_stage_id = $stage_id;
            $plan->current_sub_stage_id = $sub_stage_id;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',$stage_id)->where('sub_stage_id',$sub_stage_id)->first();
            $plan_activity->status_id = 2;
            $plan_activity->actual_start_date = date('Y-m-d');
            $plan_activity->prepared_at = now();
            $plan_activity->gyr_status = 'P';
            $plan_activity->update();
            $activity = APQPPlanActivity::find($plan->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            Mail::to('edp@venkateswarasteels.com')
            ->send(new ActivityMail($user_email,$user_name,$activity));
            //DB::commit();
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
            return response()->json(['status'=>'200','message'=>'Management Review Created Successfully!']);
        } catch (\Throwable $th) {
           // throw $th;
            DB::rollback();
            return response()->json(['status'=>500,'message' =>$th->getMessage()]);
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
<<<<<<< HEAD

=======
        //
        $meeting_id =1;
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
<<<<<<< HEAD
        $users = User::where('id','>',1)->get();
        $customers = Customer::get();
        $management_review = ManagementReview::where('apqp_timing_plan_id',$id)->first();
        // $location = $management_review->timing_plan->apqp_timing_plan_number.'/customer_ppap/';
        $management_review_data=ManagementReview::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',30)->get();
        // echo "<pre>";
        // print_r($management_review_data);
        // echo "</pre>";
        // exit;
        return view('apqp.management_review.view',compact('plan','plans','part_numbers','customers','customer_types','management_review_data'));
=======
        $customers = Customer::get();
        $sub_stages = SubStage::get();
        $users = User::get();
        $last_id = APQPPlanActivity::where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->max('sub_stage_id');
        $review_sub_stages = APQPPlanActivity::with('sub_stage')->where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->whereNotIn('sub_stage_id',array($last_id))->get();
        $management_reviews=ManagementReview::with('timing_plan')->where('apqp_timing_plan_id', $id)->get();
        // dd($management_reviews);
        return view('apqp.management_review.view',compact('plan','plans','part_numbers','customers','customer_types','meeting_id','sub_stages','review_sub_stages','users','management_reviews'));

>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $users = User::where('id','>',1)->get();
        $customers = Customer::get();
        $sub_stages = SubStage::get();
        $management_review = ManagementReview::where('apqp_timing_plan_id',$plan_id)->first();
        if($sub_stage_id==10){
            $location = $management_review->timing_plan->apqp_timing_plan_number.'/management_review1/';
        }elseif ($sub_stage_id==20) {
            $location = $management_review->timing_plan->apqp_timing_plan_number.'/management_review2/';
        }elseif ($sub_stage_id==29) {
            $location = $management_review->timing_plan->apqp_timing_plan_number.'/management_review3/';
        }elseif ($sub_stage_id==35) {
            $location = $management_review->timing_plan->apqp_timing_plan_number.'/management_review4/';
        }

        $management_review_data=ManagementReview::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        // echo "<pre>";
        // // print_r($sub_stages);
        // print_r($management_review_data);
        // echo "</pre>";
        // exit;
        return view('apqp.management_review.view',compact('plan','plans','part_numbers','customers','sub_stages','users','customer_types','management_review_data','location'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ManagementReview $managementReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateManagementReviewRequest  $request
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManagementReviewRequest $request, ManagementReview $managementReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManagementReview $managementReview)
    {
        //
    }
}
