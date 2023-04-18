<?php

namespace App\Http\Controllers;

use App\Models\ProcessFlowDiagram;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreProcessFlowDiagramRequest;
use App\Http\Requests\UpdateProcessFlowDiagramRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Auth;
use Mail;
use App\Mail\ActivityMail;


class ProcessFlowDiagramController extends Controller
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
        return view('apqp.process_flow_diagram.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcessFlowDiagramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessFlowDiagramRequest $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $processes = $request->input('process');
            $process_name = $request->input('process_name');
            $incoming_source_of_variation = $request->input('incoming_source_of_variation');
            $product_characteristics = $request->input('product_characteristics');
            $process_characteristics = $request->input('process_characteristics');
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');
            $process_identification = $request->input('process_identification');
            $process_flow_number = $request->input('process_flow_number');
            foreach ($processes as $key => $process) {
                $process_flow = new ProcessFlowDiagram;
                $process_flow->apqp_timing_plan_id = $apqp_timing_plan_id;
                $process_flow->stage_id = 2;
                $process_flow->sub_stage_id = 11;
                $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',11)->first();
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/process_flow';
                // dd($location);
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
                $file->move($location,$fileName);
                $process_flow->file = $fileName;
                $process_flow->part_number_id = $part_number_id;
                $process_flow->revision_number = $revision_number;
                $process_flow->revision_date = $revision_date;
                $process_flow->application = $application;
                $process_flow->customer_id = $customer_id;
                $process_flow->product_description = $product_description;
                $process_flow->process_identification = $process_identification;
                $process_flow->process_flow_number = $process_flow_number;
                $process_flow->process = $process;
                $process_flow->process_name = $process_name[$key];
                $process_flow->incoming_source_of_variation = $incoming_source_of_variation[$key];
                $process_flow->product_characteristics = $product_characteristics[$key];
                $process_flow->process_characteristics = $process_characteristics[$key];
                $process_flow->remarks = $request->remarks??NULL;
                $process_flow->prepared_by = auth()->user()->id;
                $process_flow->save();
            }
                // Update Timing Plan Current Activity
                $plan = APQPTimingPlan::find($apqp_timing_plan_id);
                $plan->current_stage_id = 2;
                $plan->current_sub_stage_id = 11;
                $plan->status_id = 2;
                $plan->update();
                // Update Activity
                $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',11)->first();
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
                // Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
                DB::commit();
                return response()->json(['status'=>200,'message'=>'Process Flow Diagram Created Successfully!']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>500,'message'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessFlowDiagram  $processFlowDiagram
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_stage_id=11;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $process_flow = ProcessFlowDiagram::where('apqp_timing_plan_id',$id)->first();
        $location = $process_flow->timing_plan->apqp_timing_plan_number.'/process_flow/';
        $process_flow_data=ProcessFlowDiagram::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',11)->get();

        // echo "<pre>";
        // print_r($process_flow_data);
        // echo "</pre>";exit;
        return view('apqp.process_flow_diagram.view',compact('plan','plans','part_numbers','customers','customer_types','process_flow_data','location'));
    }

            /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessFlowDiagram  $processFlowDiagram
     * @return \Illuminate\Http\Response
     */
    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $process_flow_data=ProcessFlowDiagram::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        $process_flow = ProcessFlowDiagram::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $process_flow->timing_plan->apqp_timing_plan_number.'/process_flow/';

        // echo "<pre>";
        // print_r($process_flow_data);
        // echo "</pre>";exit;
        return view('apqp.process_flow_diagram.view',compact('plan','plans','part_numbers','customers','customer_types','location','process_flow_data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessFlowDiagram  $processFlowDiagram
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessFlowDiagram $processFlowDiagram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcessFlowDiagramRequest  $request
     * @param  \App\Models\ProcessFlowDiagram  $processFlowDiagram
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessFlowDiagramRequest $request, ProcessFlowDiagram $processFlowDiagram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessFlowDiagram  $processFlowDiagram
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessFlowDiagram $processFlowDiagram)
    {
        //
    }
}
