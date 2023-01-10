<?php

namespace App\Http\Controllers;

use App\Models\CustomerSpecificRequirement;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerSpecificRequirementRequest;
use App\Http\Requests\UpdateCustomerSpecificRequirementRequest;
use Illuminate\Http\Request;

class CustomerSpecificRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('customer_requirements');
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
        return view('apqp.customer_spec_requirements.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerSpecificRequirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerSpecificRequirementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerSpecificRequirement  $customerSpecificRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerSpecificRequirement $customerSpecificRequirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerSpecificRequirement  $customerSpecificRequirement
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerSpecificRequirement $customerSpecificRequirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerSpecificRequirementRequest  $request
     * @param  \App\Models\CustomerSpecificRequirement  $customerSpecificRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerSpecificRequirementRequest $request, CustomerSpecificRequirement $customerSpecificRequirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerSpecificRequirement  $customerSpecificRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerSpecificRequirement $customerSpecificRequirement)
    {
        //
    }
}
