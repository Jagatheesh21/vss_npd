<?php

namespace App\Http\Controllers;

use App\Models\PpapPreparation;
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
use App\Http\Requests\StorePpapPreparationRequest;
use App\Http\Requests\UpdatePpapPreparationRequest;
use Illuminate\Http\Request;
use App\Mail\ActivityMail;
use Mail;

class PpapPreparationController extends Controller
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
        return view('apqp.ppap_preparation.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePpapPreparationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePpapPreparationRequest $request)
    {
       DB::beginTransaction();
        try {

            $quote = new PpapPreparation;
            $quote->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $quote->stage_id = 3;
            $quote->sub_stage_id = 28;
            $quote->part_number_id = $request->part_number_id;
            $quote->revision_number = $request->revision_number;
            $quote->revision_date = $request->revision_date;
            $quote->application = $request->application;
            $quote->customer_id = $request->customer_id;
            $quote->product_description = $request->product_description;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',3)->where('sub_stage_id',28)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/ppap_preparation';
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
            $plan->current_stage_id = 3;
            $plan->current_sub_stage_id = 28;
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
            DB::commit();
            return back()->withSuccess('PPAP Preparation Created Successfully!');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->withErrors($th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpapPreparation  $ppapPreparation
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
        $ppap_preparation = PpapPreparation::where('apqp_timing_plan_id',$id)->first();
        $location = $ppap_preparation->timing_plan->apqp_timing_plan_number.'/ppap_preparation/';
        $ppap_preparation_data=PpapPreparation::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',28)->get();
        return view('apqp.ppap_preparation.view',compact('plan','plans','part_numbers','customers','customer_types','ppap_preparation_data','location'));
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $users = User::where('id','>',1)->get();
        $customers = Customer::get();
        $ppap_preparation = PpapPreparation::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $ppap_preparation->timing_plan->apqp_timing_plan_number.'/ppap_preparation/';
        $ppap_preparation_data=PpapPreparation::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        // echo "<pre>";
        // print_r($ppap_preparation_data);
        // echo "</pre>";
        // exit;
        return view('apqp.ppap_preparation.view',compact('plan','plans','part_numbers','customers','customer_types','ppap_preparation_data','location'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PpapPreparation  $ppapPreparation
     * @return \Illuminate\Http\Response
     */
    public function edit(PpapPreparation $ppapPreparation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePpapPreparationRequest  $request
     * @param  \App\Models\PpapPreparation  $ppapPreparation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePpapPreparationRequest $request, PpapPreparation $ppapPreparation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpapPreparation  $ppapPreparation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpapPreparation $ppapPreparation)
    {
        //
    }
}
