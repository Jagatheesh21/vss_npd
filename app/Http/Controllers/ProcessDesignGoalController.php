<?php

namespace App\Http\Controllers;

use App\Models\ProcessDesignGoal;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\User;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProcessDesignGoalRequest;
use App\Http\Requests\UpdateProcessDesignGoalRequest;

class ProcessDesignGoalController extends Controller
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
        return view('apqp.process_design_goal.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcessDesignGoalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessDesignGoalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessDesignGoal $processDesignGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessDesignGoal $processDesignGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcessDesignGoalRequest  $request
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessDesignGoalRequest $request, ProcessDesignGoal $processDesignGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessDesignGoal  $processDesignGoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessDesignGoal $processDesignGoal)
    {
        //
    }
}
