<?php

namespace App\Http\Controllers;

use App\Models\ExperienceSharing;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Requests\StoreExperienceSharingRequest;
use App\Http\Requests\UpdateExperienceSharingRequest;

class ExperienceSharingController extends Controller
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
        return view('apqp.experience_sharing.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExperienceSharingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExperienceSharingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function show(ExperienceSharing $experienceSharing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function edit(ExperienceSharing $experienceSharing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExperienceSharingRequest  $request
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperienceSharingRequest $request, ExperienceSharing $experienceSharing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExperienceSharing  $experienceSharing
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExperienceSharing $experienceSharing)
    {
        //
    }
}
