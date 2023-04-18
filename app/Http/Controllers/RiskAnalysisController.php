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
use Illuminate\Support\Facades\File;
use Mail;
use Auth;
use Carbon\Carbon;
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

            $type = $request->input('type');
            $risks = $request->input('risks');
            $risk_involved = $request->input('risk_involved');
            $risk_level = $request->input('risk_level');
            $high_risks = $request->input('high_risk');

            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',4)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/risk_analysis';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);

            foreach ($high_risks as $key => $high_risk) {
                $risk = new RiskAnalysis;
                $risk->apqp_timing_plan_id = $apqp_timing_plan_id;
                $risk->stage_id = 1;
                $risk->sub_stage_id = 4;
                $risk->part_number_id = $part_number_id;
                $risk->revision_number = $revision_number;
                $risk->revision_date = $revision_date;
                $risk->application = $application;
                $risk->customer_id = $customer_id;
                $risk->file = $fileName;
                $risk->remarks = $request->remarks??NULL;
                // dd($request->remarks);
                $risk->product_description = $product_description;
                $risk->type = $type[$key];
                $risk->risks = $risks[$key];
                $risk->risk_involved = $risk_involved[$key];
                $risk->risk_level = $risk_level[$key];
                $risk->high_risk = $high_risk;
                $risk->save();

            }

             // Update Timing Plan Current Activity
             $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
            $plan->current_stage_id = 1;
            $plan->current_sub_stage_id = 4;
            $plan->status_id = 2;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',4)->first();
            $plan_activity->status_id = 2;
            $plan_activity->actual_start_date = Carbon::now();
            $plan_activity->prepared_by = auth()->user()->id;
            $plan_activity->prepared_at = Carbon::now();
            $plan_activity->gyr_status = 'Y';
            $plan_activity->update();
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            $ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
             Mail::to('r.naveen@venkateswarasteels.com')
            //  Mail::to('edp@venkateswarasteels.com')
            // ->cc($ccEmails)
             ->send(new ActivityMail($user_email,$user_name,$activity));
            DB::commit();
            return response()->json(['status'=>'200','message'=>'Risk Analysis Created Successfully!']);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            return response()->json(['status'=>'500','message'=>$th->getMessage()]);

        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_stage_id=4;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $riskAnalysis = RiskAnalysis::where('apqp_timing_plan_id',$id)->first();
        $location = $riskAnalysis->timing_plan->apqp_timing_plan_number.'/risk_analysis/';
        $risk_analysis_data=RiskAnalysis::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',4)->get();

        // echo "<pre>";
        // print_r($risk_analysis_data);
        // echo "</pre>";exit;
        return view('apqp.risk_analysis.view',compact('plan','plans','part_numbers','customers','customer_types','risk_analysis_data','location'));

    }
        /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $riskAnalysis = RiskAnalysis::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $riskAnalysis->timing_plan->apqp_timing_plan_number.'/risk_analysis/';
        $risk_analysis_data=RiskAnalysis::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();

        // echo "<pre>";
        // print_r($risk_analysis_data);
        // echo "</pre>";exit;
        return view('apqp.risk_analysis.view',compact('plan','plans','part_numbers','customers','customer_types','risk_analysis_data','location'));

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
