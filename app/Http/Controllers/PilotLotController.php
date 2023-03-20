<?php

namespace App\Http\Controllers;

use App\Models\PilotLot;
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
use App\Http\Requests\StorePilotLotRequest;
use App\Http\Requests\UpdatePilotLotRequest;
use Illuminate\Http\Request;
use App\Mail\ActivityMail;
use Mail;

class PilotLotController extends Controller
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
        return view('apqp.pilot_lot.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePilotLotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePilotLotRequest $request)
    {
        try {

            $quote = new PilotLot;
            $quote->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $quote->stage_id = 3;
            $quote->sub_stage_id = 21;
            $quote->part_number_id = $request->part_number_id;
            $quote->revision_number = $request->revision_number;
            $quote->revision_date = $request->revision_date;
            $quote->application = $request->application;
            $quote->customer_id = $request->customer_id;
            $quote->product_description = $request->product_description;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',3)->where('sub_stage_id',21)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/pilot_lot';
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
            $plan->current_sub_stage_id = 21;
            $plan->update();
            // Update Activity
            $plan_activity->status_id = 4;
            $plan_activity->actual_start_date = date('Y-m-d');
            $plan_activity->actual_end_date = date('Y-m-d');
            $plan_activity->gyr_status = 'G';
            $plan_activity->update();
            $activity = APQPPlanActivity::find($plan->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // Mail Function
            Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            return back()->withSuccess('Pilot Lot Created Successfully!');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function show(PilotLot $pilotLot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function edit(PilotLot $pilotLot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePilotLotRequest  $request
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePilotLotRequest $request, PilotLot $pilotLot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function destroy(PilotLot $pilotLot)
    {
        //
    }
}
