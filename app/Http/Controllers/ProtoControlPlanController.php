<?php

namespace App\Http\Controllers;

use App\Models\ProtoControlPlan;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StoreProtoControlPlanRequest;
use App\Http\Requests\UpdateProtoControlPlanRequest;
use Illuminate\Http\Request;
class ProtoControlPlanController extends Controller
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
        return view('apqp.proto_control_plan.create',compact('plan','plans','part_numbers','customers','customer_types','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProtoControlPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProtoControlPlanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProtoControlPlan  $protoControlPlan
     * @return \Illuminate\Http\Response
     */
    public function show(ProtoControlPlan $protoControlPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProtoControlPlan  $protoControlPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(ProtoControlPlan $protoControlPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProtoControlPlanRequest  $request
     * @param  \App\Models\ProtoControlPlan  $protoControlPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProtoControlPlanRequest $request, ProtoControlPlan $protoControlPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProtoControlPlan  $protoControlPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProtoControlPlan $protoControlPlan)
    {
        //
    }
}
