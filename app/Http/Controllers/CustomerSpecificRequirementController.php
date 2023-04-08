<?php

namespace App\Http\Controllers;

use App\Models\CustomerSpecificRequirement;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerSpecificRequirementRequest;
use App\Http\Requests\UpdateCustomerSpecificRequirementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Mail;
use App\Mail\ActivityMail;

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
    DB::beginTransaction();
    try {
        $customer = CustomerSpecificRequirement::Create($request->validated());

        // Update Timing Plan
        $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
        $plan->current_stage_id = 1;
        $plan->current_sub_stage_id = 6;
        $plan->update();
        // Update Activity
        $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',6)->first();
        $plan_activity->status_id = 2;
        $plan_activity->actual_start_date = date('Y-m-d');
        $plan_activity->prepared_at = Carbon::now();
        $plan_activity->gyr_status = 'P';
        $plan_activity->update();
        // Mail
        $activity = APQPPlanActivity::find($plan_activity->id);
        $user_email = auth()->user()->email;
        $user_name = auth()->user()->name;
        Mail::to('r.naveen@venkateswarasteels.com')
        ->send(new ActivityMail($user_email,$user_name,$activity));
        DB::commit();
        return back()->withSuccess('Customer Specific Requirements Creatred Successfully!');
    } catch (\Throwable $th) {
        //throw $th;
        DB::rollback();
        return back()->withErrors($th->getMessage());
    }
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
