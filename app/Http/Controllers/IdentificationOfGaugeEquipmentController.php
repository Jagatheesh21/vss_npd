<?php

namespace App\Http\Controllers;

use App\Models\IdentificationOfGaugeEquipment;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreIdentificationOfGaugeEquipmentRequest;
use App\Http\Requests\UpdateIdentificationOfGaugeEquipmentRequest;
use Illuminate\Http\Request;
class IdentificationOfGaugeEquipmentController extends Controller
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
        return view('apqp.customer_spec_requirements.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdentificationOfGaugeEquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentificationOfGaugeEquipmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationOfGaugeEquipment $identificationOfGaugeEquipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationOfGaugeEquipment $identificationOfGaugeEquipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationOfGaugeEquipmentRequest  $request
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentificationOfGaugeEquipmentRequest $request, IdentificationOfGaugeEquipment $identificationOfGaugeEquipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationOfGaugeEquipment $identificationOfGaugeEquipment)
    {
        //
    }
}
