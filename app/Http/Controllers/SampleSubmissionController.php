<?php

namespace App\Http\Controllers;

use App\Models\SampleSubmission;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\User;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Requests\StoreSampleSubmissionRequest;
use App\Http\Requests\UpdateSampleSubmissionRequest;

class SampleSubmissionController extends Controller
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
        return view('apqp.sample_submission.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSampleSubmissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSampleSubmissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SampleSubmission  $sampleSubmission
     * @return \Illuminate\Http\Response
     */
    public function show(SampleSubmission $sampleSubmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SampleSubmission  $sampleSubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(SampleSubmission $sampleSubmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSampleSubmissionRequest  $request
     * @param  \App\Models\SampleSubmission  $sampleSubmission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSampleSubmissionRequest $request, SampleSubmission $sampleSubmission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SampleSubmission  $sampleSubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(SampleSubmission $sampleSubmission)
    {
        //
    }
}
