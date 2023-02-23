<?php

namespace App\Http\Controllers;

use App\Models\ManagementReview;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreManagementReviewRequest;
use App\Http\Requests\UpdateManagementReviewRequest;

class ManagementReviewController extends Controller
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
        $meeting_id = $request->meeting_id;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $sub_stages = SubStage::get();
        $users = User::get();
        $review_sub_stages = APQPPlanActivity::with('sub_stage')->where("apqp_timing_plan_id",$id)->where("stage_id",$meeting_id)->get();
        return view('apqp.management_review.create',compact('plan','plans','part_numbers','customers','customer_types','meeting_id','sub_stages','review_sub_stages','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreManagementReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManagementReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function show(ManagementReview $managementReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ManagementReview $managementReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateManagementReviewRequest  $request
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManagementReviewRequest $request, ManagementReview $managementReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManagementReview $managementReview)
    {
        //
    }
}
