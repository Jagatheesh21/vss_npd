<?php

namespace App\Http\Controllers;

use App\Models\ProcessFlowDiagram;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreProcessFlowDiagramRequest;
use App\Http\Requests\UpdateProcessFlowDiagramRequest;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessFlowDiagram  $processFlowDiagram
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessFlowDiagram $processFlowDiagram)
    {
        //
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
