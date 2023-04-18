<?php

namespace App\Http\Controllers;

use App\Models\WorkInstruction;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\StoreWorkInstructionRequest;
use App\Http\Requests\UpdateWorkInstructionRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Mail\ActivityMail;
use Mail;

class WorkInstructionController extends Controller
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
        return view('apqp.work_instructions.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkInstructionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkInstructionRequest $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $part_number_id = $request->part_number_id;
            $customer_id = $request->customer_id;
            $revision_number = $request->revision_number;
            $revision_date = $request->revision_date;
            $application = $request->application;
            $product_description = $request->product_description;
            $reference_numbers = $request->reference_number;
            $description = $request->description;
            $inspection_method = $request->inspection_method;
            $remarks = $request->remarks;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',17)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/work_instructions';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            foreach ($reference_numbers as $key => $reference_number) {
                $work = new WorkInstruction;
                $work->apqp_timing_plan_id = $apqp_timing_plan_id;
                $work->part_number_id = $part_number_id;
                $work->revision_number = $revision_number;
                $work->revision_date = $revision_date;
                $work->application = $application;
                $work->customer_id = $customer_id;
                $work->product_description = $product_description;
                $work->reference_number = $reference_number;
                $work->description = $description[$key];
                $work->inspection_method = $inspection_method[$key];
                $work->remarks = $remarks[$key];
                $work->file = $fileName;
                $work->prepared_by = auth()->user()->id;
                $work->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
            $plan->current_stage_id = 2;
            $plan->current_sub_stage_id = 17;
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
            Mail::to('r.naveen@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            DB::commit();
            return response()->json(['status'=>200,'message'=>'Work Instructions Added Successfully!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>500,'message'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkInstruction  $workInstruction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $workinstruction_data=WorkInstruction::with('timing_plan')->where('apqp_timing_plan_id', $id)->get();
        $work_instructions = WorkInstruction::where('apqp_timing_plan_id',$id)->first();
        $location = $work_instructions->timing_plan->apqp_timing_plan_number.'/work_instructions/';
        return view('apqp.work_instructions.view',compact('plan','plans','part_numbers','customers','customer_types','workinstruction_data','location'));

    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $work_instructions = WorkInstruction::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $work_instructions->timing_plan->apqp_timing_plan_number.'/work_instructions/';
        $workinstruction_data=WorkInstruction::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->get();
        return view('apqp.work_instructions.view',compact('plan','plans','part_numbers','customers','customer_types','workinstruction_data','location'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkInstruction  $workInstruction
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkInstruction $workInstruction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkInstructionRequest  $request
     * @param  \App\Models\WorkInstruction  $workInstruction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkInstructionRequest $request, WorkInstruction $workInstruction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkInstruction  $workInstruction
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkInstruction $workInstruction)
    {
        //
    }
}
