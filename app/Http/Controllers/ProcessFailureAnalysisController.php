<?php

namespace App\Http\Controllers;

use App\Models\ProcessFailureAnalysis;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StoreProcessFailureAnalysisRequest;
use App\Http\Requests\UpdateProcessFailureAnalysisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use App\Mail\ActivityMail;
class ProcessFailureAnalysisController extends Controller
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
        $users = User::where('id','>',1)->get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        return view('apqp.process_failure_analysis.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcessFailureAnalysisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessFailureAnalysisRequest $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $control_plan_number = $request->input('control_plan_number');
            $key_contact = $request->input('key_contact');
            $control_plan_type = $request->input('control_plan_type');
            $document_number = $request->input('document_number');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');
            $location = $request->input('location');
            $core_team = $request->input('core_team');
            $process_descriptions = $request->input('process_description');
            $process_requirements = $request->input('process_requirements');
            $potential_failure_mode = $request->input('potential_failure_mode');
            $potential_effects_of_failure = $request->input('potential_effects_of_failure');
            $severity = $request->input('severity');
            $failure_class = $request->input('failure_class');
            $potential_causes = $request->input('potential_causes');
            $control_prevention = $request->input('control_prevention');
            $occurance = $request->input('occurance');
            $control_detection = $request->input('control_detection');
            $detection = $request->input('detection');
            $rpn = $request->input('rpn');
            $so = $request->input('so');
            $sd = $request->input('sd');
            foreach ($process_descriptions as $key => $process_description) {
                $analysis = new ProcessFailureAnalysis;
                $analysis->apqp_timing_plan_id = $apqp_timing_plan_id;
                $analysis->stage_id = 2;
                $analysis->sub_stage_id = 13;
                $analysis->part_number_id = $part_number_id;
                $analysis->revision_number = $revision_number;
                $analysis->revision_date = $revision_date;
                $analysis->customer_id = $customer_id;
                $analysis->application = $application;
                $analysis->location = $location;
                $analysis->core_team = json_encode($core_team);
                $analysis->process_description = $process_description;
                $analysis->process_requirements = $process_requirements[$key];
                $analysis->potential_failure_mode = $potential_failure_mode[$key];
                $analysis->potential_effects_of_failure = $potential_effects_of_failure[$key];
                $analysis->severity = $severity[$key];
                $analysis->failure_class = $failure_class[$key];
                $analysis->potential_causes = $potential_causes[$key];
                $analysis->control_prevention = $control_prevention[$key];
                $analysis->occurance = $occurance[$key];
                $analysis->detection = $detection[$key];
                $analysis->rpn = $rpn[$key];
                $analysis->so = $so[$key];
                $analysis->sd = $sd[$key];
                $analysis->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 2;
            $plan->current_sub_stage_id = 13;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',13)->first();
            $plan_activity->status_id = 4;
            $plan_activity->actual_start_date = date('Y-m-d');
            $plan_activity->actual_end_date = date('Y-m-d');
            $plan_activity->gyr_status = 'G';
            $plan_activity->update();
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // Mail Function
            Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));

            DB::commit();
            return response()->json(['status'=>200,'message'=>'Process Failur Analysis Created Successfully!']);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>500,'message'=>$th->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessFailureAnalysis  $processFailureAnalysis
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessFailureAnalysis $processFailureAnalysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessFailureAnalysis  $processFailureAnalysis
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessFailureAnalysis $processFailureAnalysis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcessFailureAnalysisRequest  $request
     * @param  \App\Models\ProcessFailureAnalysis  $processFailureAnalysis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessFailureAnalysisRequest $request, ProcessFailureAnalysis $processFailureAnalysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessFailureAnalysis  $processFailureAnalysis
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessFailureAnalysis $processFailureAnalysis)
    {
        //
    }
}
