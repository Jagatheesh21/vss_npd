<?php

namespace App\Http\Controllers;

use App\Models\RiskAnalysis;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\APQPPlanActivity;
use App\Http\Requests\StoreRiskAnalysisRequest;
use App\Http\Requests\UpdateRiskAnalysisRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\ActivityMail;

class RiskAnalysisController extends Controller
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
        return view('apqp.risk_analysis.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRiskAnalysisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskAnalysisRequest $request)
    {
        try {
            //code...
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');

            $types = $request->input('type');
            $risks = $request->input('risks');
            $risk_involved = $request->input('risk_involved');
            $risk_level = $request->input('risk_level');
            $high_risk = $request->input('high_risk');
            foreach ($types as $key => $type) {
                $risk = new RiskAnalysis;
                $risk->apqp_timing_plan_id = $apqp_timing_plan_id;
                $risk->stage_id = 1;
                $risk->sub_stage_id = 4;
                $risk->part_number_id = $part_number_id;
                $risk->revision_number = $revision_number;
                $risk->revision_date = $revision_date;
                $risk->application = $application;
                $risk->customer_id = $customer_id;
                $risk->product_description = $product_description;
                $risk->type = $type;
                $risk->risks = $risks[$key];
                $risk->risks = $risks[$key];
                $risk->risk_involved = $risk_involved[$key];
                $risk->risk_level = $risk_level[$key];
                $risk->high_risk = $high_risk[$key];
                $risk->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 1;
            $plan->current_sub_stage_id = 4;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',4)->first();
            $plan_activity->status_id = 4;
            $plan_activity->actual_start_date = date('Y-m-d');
            $plan_activity->actual_end_date = date('Y-m-d');
            $plan_activity->gyr_status = 'G';
            $plan_activity->update();
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // $ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            // Mail::to('r.naveen@venkateswarasteels.com')
            // ->cc($cc_emails)
            // ->send(new ActivityMail($user_email,$user_name,$activity));
            return response()->json(['status'=>'200','message'=>'Risk Analysis Created Successfully!']);


        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'500','message'=>$th->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function show(RiskAnalysis $riskAnalysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskAnalysis $riskAnalysis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskAnalysisRequest  $request
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskAnalysisRequest $request, RiskAnalysis $riskAnalysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiskAnalysis $riskAnalysis)
    {
        //
    }
}
