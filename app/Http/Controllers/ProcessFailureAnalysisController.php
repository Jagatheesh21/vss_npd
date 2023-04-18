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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
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
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',13)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/process_failure_analysis';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
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
                $analysis->file = $fileName;
                $analysis->remarks = $request->remarks??NULL;
                $analysis->prepared_by = auth()->user()->id;
                $analysis->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 2;
            $plan->current_sub_stage_id = 13;
            $plan->status_id = 2;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',13)->first();
            $plan_activity->actual_start_date = Carbon::now();
            $plan_activity->prepared_by = auth()->user()->id;
            $plan_activity->prepared_at = Carbon::now();
            $plan_activity->status_id = 2;
            $plan_activity->gyr_status = "Y";
            $plan_activity->update();

            // Mail Function
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            Mail::to('r.naveen@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));

            DB::commit();
            return response()->json(['status'=>200,'message'=>'Process Failure Analysis Created Successfully!']);

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
    public function show($id)
    {
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $users = User::where('id','>',1)->get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $process_failure_analysis = ProcessFailureAnalysis::where('apqp_timing_plan_id',$id)->first();
        $location = $process_failure_analysis->timing_plan->apqp_timing_plan_number.'/process_failure_analysis/';
        $process_flow_data=ProcessFailureAnalysis::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',13)->get();
        // echo "<pre>";
        // print_r($process_flow_data);
        // echo "</pre>";exit;
        return view('apqp.process_failure_analysis.view',compact('plan','users','plans','part_numbers','customers','customer_types','process_flow_data','location'));
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $users = User::where('id','>',1)->get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $process_failure_analysis = ProcessFailureAnalysis::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $process_failure_analysis->timing_plan->apqp_timing_plan_number.'/process_failure_analysis/';
        $process_flow_data=ProcessFailureAnalysis::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        // echo "<pre>";
        // print_r($process_flow_data);
        // echo "</pre>";exit;
        return view('apqp.process_failure_analysis.view',compact('plan','users','plans','part_numbers','customers','customer_types','process_flow_data','location'));
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
