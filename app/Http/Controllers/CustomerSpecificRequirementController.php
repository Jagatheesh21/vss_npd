<?php

namespace App\Http\Controllers;

use App\Models\CustomerSpecificRequirement;
use App\Http\Requests\StoreCustomerSpecificRequirementRequest;
use App\Http\Requests\UpdateCustomerSpecificRequirementRequest;

class CustomerSpecificRequirementController extends Controller
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
    public function create()
    {
        //
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
