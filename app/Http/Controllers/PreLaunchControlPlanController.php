<?php

namespace App\Http\Controllers;

use App\Models\PreLaunchControlPlan;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StorePreLaunchControlPlanRequest;
use App\Http\Requests\UpdatePreLaunchControlPlanRequest;
use Illuminate\Http\Request;
class PreLaunchControlPlanController extends Controller
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
        return view('apqp.prelaunch_control_plan.create',compact('plan','plans','part_numbers','customers','customer_types','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreLaunchControlPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreLaunchControlPlanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function show(PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreLaunchControlPlanRequest  $request
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreLaunchControlPlanRequest $request, PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }
}
