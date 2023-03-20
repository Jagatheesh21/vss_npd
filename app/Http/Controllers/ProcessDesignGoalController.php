<?php

namespace App\Http\Controllers;

use App\Models\ProcessDesignGoal;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProcessDesignGoalRequest;
use App\Http\Requests\UpdateProcessDesignGoalRequest;
use Illuminate\Support\Facades\DB;
use Mail;
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
            foreach($target_cost as $key=>$target)
            {
                $special = new ProcessDesignGoal;
                $special->apqp_timing_plan_id = $apqp_timing_plan_id;
                $special->stage_id = 3;
                $special->sub_stage_id = 24;
                $special->part_number_id = $part_number_id;
                $special->revision_number = $revision_number;
                $special->revision_date = $revision_date;
                $special->application = $application;
                $special->customer_id = $customer_id;
                $special->product_description = $product_description;
                $special->target_cost = $target;
                $special->target_quality = $target_quality[$key];
                $special->target_output = $target_output[$key];
                $special->target_cpk = $target_cpk[$key];
                $special->actual_cost = $actual_cost[$key];
                $special->actual_quality = $actual_quality[$key];
                $special->actual_output = $actual_output[$key];
                $special->actual_cpk = $actual_cpk[$key];
                $special->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 3;
            $plan->current_sub_stage_id = 24;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',3)->where('sub_stage_id',24)->first();
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

            return response()->json(['status'=>'200','message'=>'Process Design Goal Created Successfully!']);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'500','message'=>$th->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessDesignGoal $processDesignGoal)
    {

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
