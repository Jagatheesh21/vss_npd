<?php

namespace App\Http\Controllers;

use App\Models\SafeLaunch;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\StoreSafeLaunchRequest;
use App\Http\Requests\UpdateSafeLaunchRequest;
use Illuminate\Http\Request;
use App\Mail\ActivityMail;
use Mail;

class SafeLaunchController extends Controller
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
        $safe_launch_id = $request->safe_launch;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        return view('apqp.safe_launch.create',compact('safe_launch_id','plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSafeLaunchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSafeLaunchRequest $request)
    {
        // echo "<pre>";
        // print_r($request);
        // echo "</pre>";exit;
        // dd($request);
        DB::beginTransaction();
        try {
            $quote = new SafeLaunch;
            $quote->safe_launch_id = $request->safe_launch_id;
            $quote->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $quote->stage_id = 4;
            $quote->sub_stage_id = $request->sub_stage_id;
            $quote->part_number_id = $request->part_number_id;
            $quote->revision_number = $request->revision_number;
            $quote->revision_date = $request->revision_date;
            $quote->application = $request->application;
            $quote->customer_id = $request->customer_id;
            $quote->product_description = $request->product_description;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',4)->where('sub_stage_id',$request->sub_stage_id)->first();
            if ($request->sub_stage_id==31) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/safe_launch1';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
                $file->move($location,$fileName);
            }elseif ($request->sub_stage_id==32) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/safe_launch2';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
                $file->move($location,$fileName);
            }elseif ($request->sub_stage_id==33) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/safe_launch3';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
                $file->move($location,$fileName);
            }elseif ($request->sub_stage_id==34) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $location = $plan_activity->plan->apqp_timing_plan_number.'/safe_launch4';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
                $file->move($location,$fileName);
            }
            $quote->file = $fileName;
            $quote->remarks = $request->remarks??NULL;
            // dd($quote);
            $quote->save();
            // Mail
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
            $plan->current_stage_id = $request->stage_id;
            $plan->current_sub_stage_id = $request->sub_stage_id;
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
            // Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            DB::commit();
            return back()->withSuccess('Safe Launch Created Successfully!');

        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SafeLaunch  $safeLaunch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $safe_launch = SafeLaunch::where('apqp_timing_plan_id',$id)->first();
        $location = $safe_launch->timing_plan->apqp_timing_plan_number.'/safe_launch/';
        $safe_launch_data=SafeLaunch::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',30)->get();
        // echo "<pre>";
        // print_r($safe_launch_data);
        // echo "</pre>";
        // exit;
        return view('apqp.safe_launch.view',compact('plan','plans','part_numbers','customers','customer_types','safe_launch_data','location'));
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $safe_launch_id = $sub_stage_id;
        $customers = Customer::get();
        $safe_launch = SafeLaunch::where('apqp_timing_plan_id',$plan_id)->first();
        if($sub_stage_id==31){
            $location = $safe_launch->timing_plan->apqp_timing_plan_number.'/safe_launch1/';
        }elseif ($sub_stage_id==32) {
            $location = $safe_launch->timing_plan->apqp_timing_plan_number.'/safe_launch2/';
        }elseif ($sub_stage_id==33) {
            $location = $safe_launch->timing_plan->apqp_timing_plan_number.'/safe_launch3/';
        }elseif ($sub_stage_id==34) {
            $location = $safe_launch->timing_plan->apqp_timing_plan_number.'/safe_launch4/';
        }
        $safe_launch_data=SafeLaunch::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        // echo "<pre>";
        // print_r($safe_launch_data);
        // echo "</pre>";
        // exit;
        return view('apqp.safe_launch.view',compact('plan','plans','part_numbers','customers','safe_launch_id','customer_types','safe_launch_data','location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SafeLaunch  $safeLaunch
     * @return \Illuminate\Http\Response
     */
    public function edit(SafeLaunch $safeLaunch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSafeLaunchRequest  $request
     * @param  \App\Models\SafeLaunch  $safeLaunch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSafeLaunchRequest $request, SafeLaunch $safeLaunch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SafeLaunch  $safeLaunch
     * @return \Illuminate\Http\Response
     */
    public function destroy(SafeLaunch $safeLaunch)
    {
        //
    }
}
