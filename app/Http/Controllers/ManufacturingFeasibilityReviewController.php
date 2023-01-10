<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingFeasibilityReview;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;

use App\Http\Requests\StoreManufacturingFeasibilityReviewRequest;
use App\Http\Requests\UpdateManufacturingFeasibilityReviewRequest;
use Illuminate\Http\Request;

class ManufacturingFeasibilityReviewController extends Controller
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
        return view('apqp.mfr.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreManufacturingFeasibilityReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManufacturingFeasibilityReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function show(ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateManufacturingFeasibilityReviewRequest  $request
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufacturingFeasibilityReviewRequest $request, ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }
}
