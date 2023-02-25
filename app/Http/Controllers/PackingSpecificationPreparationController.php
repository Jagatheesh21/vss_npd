<?php

namespace App\Http\Controllers;

use App\Models\PackingSpecificationPreparation;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\User;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Requests\StorePackingSpecificationPreparationRequest;
use App\Http\Requests\UpdatePackingSpecificationPreparationRequest;

class PackingSpecificationPreparationController extends Controller
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
        return view('apqp.packing_specification.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackingSpecificationPreparationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackingSpecificationPreparationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackingSpecificationPreparation  $packingSpecificationPreparation
     * @return \Illuminate\Http\Response
     */
    public function show(PackingSpecificationPreparation $packingSpecificationPreparation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackingSpecificationPreparation  $packingSpecificationPreparation
     * @return \Illuminate\Http\Response
     */
    public function edit(PackingSpecificationPreparation $packingSpecificationPreparation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackingSpecificationPreparationRequest  $request
     * @param  \App\Models\PackingSpecificationPreparation  $packingSpecificationPreparation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackingSpecificationPreparationRequest $request, PackingSpecificationPreparation $packingSpecificationPreparation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackingSpecificationPreparation  $packingSpecificationPreparation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackingSpecificationPreparation $packingSpecificationPreparation)
    {
        //
    }
}
