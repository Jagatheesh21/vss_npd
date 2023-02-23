<?php

namespace App\Http\Controllers;

use App\Models\WorkInstruction;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreWorkInstructionRequest;
use App\Http\Requests\UpdateWorkInstructionRequest;
use Illuminate\Http\Request;

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
                $work->save();
            }
            return response()->json(['status'=>200,'message'=>'Work Instructions Added Successfully!']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>500,'message'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkInstruction  $workInstruction
     * @return \Illuminate\Http\Response
     */
    public function show(WorkInstruction $workInstruction)
    {
        //
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
