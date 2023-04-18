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
use Illuminate\Support\Facades\File;
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
            $customer_spec=new CustomerSpecificRequirement;
            $customer_spec->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $customer_spec->stage_id = 1;
            $customer_spec->sub_stage_id = 6;
            $customer_spec->customer_id = $request->customer_id;
            $customer_spec->application = $request->application;
            $customer_spec->part_number_id = $request->part_number_id;
            $customer_spec->revision_number = $request->revision_number;
            $customer_spec->revision_date = $request->revision_date;
            $customer_spec->manufacturing_requirements = $request->manufacturing_requirements;
            $customer_spec->handling_requirements = $request->handling_requirements;
            $customer_spec->marking_requirements = $request->marking_requirements;
            $customer_spec->packing_preservation = $request->packing_preservation;
            $customer_spec->delivery_requirements = $request->delivery_requirements;
            $customer_spec->document_requirements = $request->document_requirements;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',2)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/customer_spec';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            $customer_spec->file = $fileName;
            $customer_spec->remarks = $request->remarks??NULL;
            $customer_spec->prepared_by = auth()->user()->id;
            $customer_spec->save();
             // Update Timing Plan Current Activity
             $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
             $plan->current_stage_id = 1;
             $plan->current_sub_stage_id = 6;
             $plan->status_id = 2;
             $plan->update();
             // Update Activity
             $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',6)->first();
             $plan_activity->actual_start_date = Carbon::now();
             $plan_activity->prepared_by = auth()->user()->id;
             $plan_activity->prepared_at = Carbon::now();
             $plan_activity->status_id = 2;
             $plan_activity->gyr_status = "Y";
             $plan_activity->update();
             //
             $activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->first();
             $user_email = auth()->user()->email;
             $user_name = auth()->user()->name;
             // Mail Function
             // $ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
             // $ccEmails = ["edp@venkateswarasteels.com"];
             Mail::to('r.naveen@venkateswarasteels.com')
            //  Mail::to('edp@venkateswarasteels.com')
             //->cc($ccEmails)

             ->send(new ActivityMail($user_email,$user_name,$activity));
             DB::commit();
             return back()->withSuccess('Customer Specific Requirements Created Successfully!');

        } catch (\Throwable $th) {
            // throw $th;
           DB::rollback();
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerSpecificRequirement  $customerSpecificRequirement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $customerSpecificRequirement = CustomerSpecificRequirement::where('apqp_timing_plan_id',$id)->first();
        $location = $customerSpecificRequirement->timing_plan->apqp_timing_plan_number.'/customer_spec/';
        $specfication=CustomerSpecificRequirement::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',6)->get();
        // echo "<pre>";
        // print_r($specfication);
        // echo "</pre>";exit;
        // dd($specfication);
        return view('apqp.customer_spec_requirements.view',compact('plan','plans','part_numbers','customers','customer_types','specfication','location'));
    }


    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $specfication=CustomerSpecificRequirement::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        $customerSpecificRequirement = CustomerSpecificRequirement::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $customerSpecificRequirement->timing_plan->apqp_timing_plan_number.'/customer_spec/';
        // echo "<pre>";
        // print_r($specfication);
        // echo "</pre>";exit;
        // dd($specfication);
        return view('apqp.customer_spec_requirements.view',compact('plan','plans','part_numbers','customers','customer_types','specfication','location'));
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
