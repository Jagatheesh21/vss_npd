<?php

namespace App\Http\Controllers;

use App\Models\CustomerApprovalOfPpap;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerApprovalOfPpapRequest;
use App\Http\Requests\UpdateCustomerApprovalOfPpapRequest;
use App\Mail\ActivityMail;
use Mail;

class CustomerApprovalOfPpapController extends Controller
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
        return view('apqp.customer_approval_of_ppap.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerApprovalOfPpapRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerApprovalOfPpapRequest $request)
    {
        try {
            $quote = new CustomerApprovalOfPpap;
            $quote->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $quote->stage_id = 4;
            $quote->sub_stage_id = 30;
            $quote->part_number_id = $request->part_number_id;
            $quote->revision_number = $request->revision_number;
            $quote->revision_date = $request->revision_date;
            $quote->application = $request->application;
            $quote->customer_id = $request->customer_id;
            $quote->product_description = $request->product_description;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',4)->where('sub_stage_id',30)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/customer_ppap';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            $quote->file = $fileName;
            $quote->remarks = $request->remarks??NULL;
            $quote->save();
            // Mail
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
            $plan->current_stage_id = 4;
            $plan->current_sub_stage_id = 30;
            $plan->status_id = 2;
            $plan->update();

            // Update Activity
            $plan_activity->actual_start_date = Carbon::now();
            $plan_activity->prepared_by = auth()->user()->id;
            $plan_activity->prepared_at = Carbon::now();
            $plan_activity->status_id = 2;
            $plan_activity->gyr_status = "Y";
            $plan_activity->update();

            // Mail Function
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // Mail Function
            Mail::to('r.naveen@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));

            return back()->withSuccess('Customer Approval Of PPAP Created Successfully!');

        } catch (\Throwable $th) {
            //throw $th;

            return back()->withErrors($th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerApprovalOfPpap  $customerApprovalOfPpap
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $users = User::where('id','>',1)->get();
        $customers = Customer::get();
        $customer_approval_of_ppap = CustomerApprovalOfPpap::where('apqp_timing_plan_id',$id)->first();
        $location = $customer_approval_of_ppap->timing_plan->apqp_timing_plan_number.'/customer_ppap/';
        $customer_approval_of_ppap_data=CustomerApprovalOfPpap::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',30)->get();
        // echo "<pre>";
        // print_r($customer_approval_of_ppap_data);
        // echo "</pre>";
        // exit;
        return view('apqp.customer_approval_of_ppap.view',compact('plan','plans','part_numbers','customers','customer_types','customer_approval_of_ppap_data','location'));
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $users = User::where('id','>',1)->get();
        $customers = Customer::get();
        $customer_approval_of_ppap = CustomerApprovalOfPpap::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $customer_approval_of_ppap->timing_plan->apqp_timing_plan_number.'/customer_ppap/';
        $customer_approval_of_ppap_data=CustomerApprovalOfPpap::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        // echo "<pre>";
        // print_r($customer_approval_of_ppap_data);
        // echo "</pre>";
        // exit;
        return view('apqp.customer_approval_of_ppap.view',compact('plan','plans','part_numbers','customers','customer_types','customer_approval_of_ppap_data','location'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerApprovalOfPpap  $customerApprovalOfPpap
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerApprovalOfPpap $customerApprovalOfPpap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerApprovalOfPpapRequest  $request
     * @param  \App\Models\CustomerApprovalOfPpap  $customerApprovalOfPpap
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerApprovalOfPpapRequest $request, CustomerApprovalOfPpap $customerApprovalOfPpap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerApprovalOfPpap  $customerApprovalOfPpap
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerApprovalOfPpap $customerApprovalOfPpap)
    {
        //
    }
}
