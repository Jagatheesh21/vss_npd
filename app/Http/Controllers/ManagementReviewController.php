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
        $users = User::get();
        $last_id = APQPPlanActivity::where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->max('sub_stage_id');
        $review_sub_stages = APQPPlanActivity::with('sub_stage')->where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->whereNotIn('sub_stage_id',array($last_id))->get();
        return view('apqp.management_review.create',compact('plan','plans','part_numbers','customers','customer_types','meeting_id','sub_stages','review_sub_stages','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreManagementReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManagementReviewRequest $request)
    {
       // dd($request->all());
       DB::beginTransaction();
        try {
            //code...
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
            foreach ($points as $key => $point) {
                $management = new ManagementReview;
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
                $management->points_discussed = $point;
                $management->responsibility = $responsibility[$key];
                $management->target_date = $target_date[$key];
                $management->actual_date = $actual_date[$key]??NULL;
                $management->delay_reason = $delay_reason[$key];
                $management->action_plan = $action_plan[$key];
                $management->revisied_target_date = $revisied_target_date[$key];
                $management->review_comments = $review_comments[$key];
                $management->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
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
        //
        $meeting_id =1;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $sub_stages = SubStage::get();
        $users = User::get();
        $last_id = APQPPlanActivity::where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->max('sub_stage_id');
        $review_sub_stages = APQPPlanActivity::with('sub_stage')->where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->whereNotIn('sub_stage_id',array($last_id))->get();
        $management_reviews=ManagementReview::with('timing_plan')->where('apqp_timing_plan_id', $id)->get();
        // dd($management_reviews);
        return view('apqp.management_review.view',compact('plan','plans','part_numbers','customers','customer_types','meeting_id','sub_stages','review_sub_stages','users','management_reviews'));

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
