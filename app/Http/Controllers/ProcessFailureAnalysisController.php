<?php

namespace App\Http\Controllers;

use App\Models\ProcessFailureAnalysis;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StoreProcessFailureAnalysisRequest;
use App\Http\Requests\UpdateProcessFailureAnalysisRequest;
use Illuminate\Http\Request;

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
        //
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
