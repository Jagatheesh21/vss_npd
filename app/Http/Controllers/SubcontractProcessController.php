<?php

namespace App\Http\Controllers;

use App\Models\SubcontractProcess;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubcontractProcessRequest;
use App\Http\Requests\UpdateSubcontractProcessRequest;

class SubcontractProcessController extends Controller
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
        return view('apqp.subcontract_process.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubcontractProcessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubcontractProcessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubcontractProcess  $subcontractProcess
     * @return \Illuminate\Http\Response
     */
    public function show(SubcontractProcess $subcontractProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubcontractProcess  $subcontractProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(SubcontractProcess $subcontractProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubcontractProcessRequest  $request
     * @param  \App\Models\SubcontractProcess  $subcontractProcess
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubcontractProcessRequest $request, SubcontractProcess $subcontractProcess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubcontractProcess  $subcontractProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubcontractProcess $subcontractProcess)
    {
        //
    }
}
