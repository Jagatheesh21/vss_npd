<?php

namespace App\Http\Controllers;

use App\Models\ExperienceSharing;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Auth;
use App\Http\Requests\StoreExperienceSharingRequest;
use App\Http\Requests\UpdateExperienceSharingRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\ActivityMail;
use Mail;

class ExperienceSharingController extends Controller
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
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        return view('apqp.experience_sharing.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExperienceSharingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExperienceSharingRequest $request)
    {
        DB::beginTransaction();
        try {

            $quote = new ExperienceSharing;
            $quote->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $quote->stage_id = $request->stage_id;
            $quote->sub_stage_id = $request->sub_stage_id;
            $quote->part_number_id = $request->part_number_id;
            $quote->revision_number = $request->revision_number;
            $quote->revision_date = $request->revision_date;
            $quote->application = $request->application;
            $quote->customer_id = $request->customer_id;
            $quote->product_description = $request->product_description;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',$request->stage_id)->where('sub_stage_id',$request->sub_stage_id)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/experience_sharing';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            $quote->file = $fileName;
            $quote->remarks = $request->remarks??NULL;
            $quote->save();
            // Mail
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
            $plan->current_stage_id = 1;
            $plan->current_sub_stage_id = 9;
            $plan->update();
            // Update Activity
            $plan_activity->status_id = 2;
            $plan_activity->actual_start_date = date('Y-m-d');
            $plan_activity->prepared_at = now();
            $plan_activity->gyr_status = 'P';
            $plan_activity->update();
            $activity = APQPPlanActivity::find($plan->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // Mail Function
            //$ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            Mail::to('r.naveen@venkateswarasteels.com')
           // ->cc($cc_emails)
            ->send(new ActivityMail($user_email,$user_name,$activity));
            DB::commit();
            return back()->withSuccess('Experience Sharing Created Successfully!');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function show(ExperienceSharing $experienceSharing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function edit(ExperienceSharing $experienceSharing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExperienceSharingRequest  $request
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperienceSharingRequest $request, ExperienceSharing $experienceSharing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExperienceSharing $experienceSharing)
    {
        //
    }
}
