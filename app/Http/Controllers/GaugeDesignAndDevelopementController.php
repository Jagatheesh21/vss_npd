<?php

namespace App\Http\Controllers;

use App\Models\GaugeDesignAndDevelopement;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Mail\ActivityMail;
use Mail;
use App\Http\Requests\StoreGaugeDesignAndDevelopementRequest;
use App\Http\Requests\UpdateGaugeDesignAndDevelopementRequest;

class GaugeDesignAndDevelopementController extends Controller
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
        return view('apqp.gauge_design.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGaugeDesignAndDevelopementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGaugeDesignAndDevelopementRequest $request)
    {

        try {

            $quote = new GaugeDesignAndDevelopement;
            $quote->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $quote->stage_id = 2;
            $quote->sub_stage_id = 14;
            $quote->part_number_id = $request->part_number_id;
            $quote->revision_number = $request->revision_number;
            $quote->revision_date = $request->revision_date;
            $quote->application = $request->application;
            $quote->customer_id = $request->customer_id;
            $quote->product_description = $request->product_description;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',14)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/gauge_design';
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
            $plan->current_stage_id = 2;
            $plan->current_sub_stage_id = 14;
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
            Mail::to('r.naveen@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            return back()->withSuccess('Gauge Design And Developement Created Successfully!');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $gauge = GaugeDesignAndDevelopement::where('apqp_timing_plan_id',$id)->first();
        $location = $gauge->timing_plan->apqp_timing_plan_number.'/gauge_design/';
        $gauge_design_data=GaugeDesignAndDevelopement::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',14)->get();
        return view('apqp.gauge_design.view',compact('plan','plans','part_numbers','customers','customer_types','location','gauge_design_data'));
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $gauge = GaugeDesignAndDevelopement::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $gauge->timing_plan->apqp_timing_plan_number.'/gauge_design/';
        $gauge_design_data=GaugeDesignAndDevelopement::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        return view('apqp.gauge_design.view',compact('plan','plans','part_numbers','customers','customer_types','location','gauge_design_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function edit(GaugeDesignAndDevelopement $gaugeDesignAndDevelopement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGaugeDesignAndDevelopementRequest  $request
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGaugeDesignAndDevelopementRequest $request, GaugeDesignAndDevelopement $gaugeDesignAndDevelopement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function destroy(GaugeDesignAndDevelopement $gaugeDesignAndDevelopement)
    {
        //
    }
}
