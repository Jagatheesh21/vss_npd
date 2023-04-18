<?php

namespace App\Http\Controllers;

use App\Models\ProcessDesignGoal;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProcessDesignGoalRequest;
use App\Http\Requests\UpdateProcessDesignGoalRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Mail;
use Auth;
use App\Mail\ActivityMail;

class ProcessDesignGoalController extends Controller
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
        return view('apqp.process_design_goal.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcessDesignGoalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessDesignGoalRequest $request)
    {
        DB::beginTransaction();
        try {
            $target_cost = $request->input('target_cost');
            $target_quality = $request->input('target_quality');
            $target_output = $request->input('target_output');
            $target_cpk = $request->input('target_cpk');
            $actual_cost = $request->input('actual_cost');
            $actual_quality = $request->input('actual_quality');
            $actual_output = $request->input('actual_output');
            $actual_cpk = $request->input('actual_cpk');

            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');
            foreach($target_cpk as $key=>$target)
            {
                $special = new ProcessDesignGoal;
                $special->apqp_timing_plan_id = $apqp_timing_plan_id;
                $special->stage_id = 3;
                $special->sub_stage_id = 25;
                $special->part_number_id = $part_number_id;
                $special->revision_number = $revision_number;
                $special->revision_date = $revision_date;
                $special->application = $application;
                $special->customer_id = $customer_id;
                $special->product_description = $product_description;
                $special->target_cost = $target_cost[$key];
                $special->target_quality = $target_quality[$key];
                $special->target_output = $target_output[$key];
                $special->target_cpk = $target_cpk[$key];
                $special->actual_cost = $actual_cost[$key];
                $special->actual_quality = $actual_quality[$key];
                $special->actual_output = $actual_output[$key];
                $special->actual_cpk = $actual_cpk[$key];
                $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',3)->where('sub_stage_id',25)->first();
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/process_design_goal';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
                $file->move($location,$fileName);
                $special->file = $fileName;
                $special->remarks = $request->remarks??NULL;
                $special->prepared_by = auth()->user()->id;
                $special->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 3;
            $plan->current_sub_stage_id = 25;
            $plan->status_id = 2;
            $plan->update();

            // Update Activity
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
            return response()->json(['status'=>'200','message'=>'Process Design Goal Created Successfully!']);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'500','message'=>$th->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $users = User::where('id','>',1)->get();
        $process_design_goal_data=ProcessDesignGoal::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',25)->get();
        $process_design_goal = ProcessDesignGoal::where('apqp_timing_plan_id',$id)->first();
        $location = $process_design_goal->timing_plan->apqp_timing_plan_number.'/process_design_goal/';
        // echo "<pre>";
        // print_r($process_design_goal_data);echo "</pre>";
        // exit;
        return view('apqp.process_design_goal.view',compact('plan','plans','part_numbers','customers','customer_types','users','process_design_goal_data','location'));

    }
    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $users = User::where('id','>',1)->get();
        $process_design_goal = ProcessDesignGoal::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $process_design_goal->timing_plan->apqp_timing_plan_number.'/process_design_goal/';
        $process_design_goal_data=ProcessDesignGoal::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        // echo "<pre>";
        // print_r($process_design_goal_data);echo "</pre>";
        // exit;
        return view('apqp.process_design_goal.view',compact('plan','plans','part_numbers','customers','customer_types','users','process_design_goal_data','location'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessDesignGoal $processDesignGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcessDesignGoalRequest  $request
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessDesignGoalRequest $request, ProcessDesignGoal $processDesignGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessDesignGoal $processDesignGoal)
    {
        //
    }
}
