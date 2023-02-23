<?php

namespace App\Http\Controllers;

use App\Models\MsaStudy;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMsaStudyRequest;
use App\Http\Requests\UpdateMsaStudyRequest;

class MsaStudyController extends Controller
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
        return view('apqp.msa_study.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMsaStudyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMsaStudyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MsaStudy  $msaStudy
     * @return \Illuminate\Http\Response
     */
    public function show(MsaStudy $msaStudy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MsaStudy  $msaStudy
     * @return \Illuminate\Http\Response
     */
    public function edit(MsaStudy $msaStudy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMsaStudyRequest  $request
     * @param  \App\Models\MsaStudy  $msaStudy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMsaStudyRequest $request, MsaStudy $msaStudy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MsaStudy  $msaStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy(MsaStudy $msaStudy)
    {
        //
    }
}
