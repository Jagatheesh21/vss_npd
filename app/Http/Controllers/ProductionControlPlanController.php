<?php

namespace App\Http\Controllers;

use App\Models\ProductionControlPlan;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StoreProductionControlPlanRequest;
use App\Http\Requests\UpdateProductionControlPlanRequest;
use Illuminate\Http\Request;
class ProductionControlPlanController extends Controller
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
        $users = User::where('id','>',1)->get();
        return view('apqp.production_control_plan.create',compact('plan','plans','part_numbers','customers','customer_types','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductionControlPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductionControlPlanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductionControlPlan  $productionControlPlan
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionControlPlan $productionControlPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductionControlPlan  $productionControlPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductionControlPlan $productionControlPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductionControlPlanRequest  $request
     * @param  \App\Models\ProductionControlPlan  $productionControlPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductionControlPlanRequest $request, ProductionControlPlan $productionControlPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionControlPlan  $productionControlPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionControlPlan $productionControlPlan)
    {
        //
    }
}
