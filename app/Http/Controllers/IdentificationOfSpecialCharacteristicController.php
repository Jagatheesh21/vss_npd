<?php

namespace App\Http\Controllers;

use App\Models\IdentificationOfSpecialCharacteristic;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;

use App\Http\Requests\StoreIdentificationOfSpecialCharacteristicRequest;
use App\Http\Requests\UpdateIdentificationOfSpecialCharacteristicRequest;
use Illuminate\Http\Request;

class IdentificationOfSpecialCharacteristicController extends Controller
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
        return view('apqp.special_characteristics.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdentificationOfSpecialCharacteristicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentificationOfSpecialCharacteristicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationOfSpecialCharacteristic $identificationOfSpecialCharacteristic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationOfSpecialCharacteristic $identificationOfSpecialCharacteristic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationOfSpecialCharacteristicRequest  $request
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentificationOfSpecialCharacteristicRequest $request, IdentificationOfSpecialCharacteristic $identificationOfSpecialCharacteristic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationOfSpecialCharacteristic $identificationOfSpecialCharacteristic)
    {
        //
    }
}
