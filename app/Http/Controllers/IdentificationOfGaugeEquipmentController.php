<?php

namespace App\Http\Controllers;

use App\Models\IdentificationOfGaugeEquipment;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreIdentificationOfGaugeEquipmentRequest;
use App\Http\Requests\UpdateIdentificationOfGaugeEquipmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use App\Mail\ActivityMail;
use Mail;
class IdentificationOfGaugeEquipmentController extends Controller
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
        return view('apqp.gauge_equipment.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdentificationOfGaugeEquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentificationOfGaugeEquipmentRequest $request)
    {

        DB::beginTransaction();
        try {
            //code...
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');
            $stages = $request->input('stage');
            $gauge_number = $request->input('gauge_number');
            $to_check = $request->input('to_check');
            $sample_size = $request->input('sample_size');
            $frequency = $request->input('frequency');
            $photo = $request->file('photo');
            foreach ($stages as $key => $stage) {
                $gauge = new IdentificationOfGaugeEquipment;
                $gauge->apqp_timing_plan_id = $apqp_timing_plan_id;
                $gauge->stage_id = 1;
                $gauge->sub_stage_id = 8;
                $gauge->part_number_id = $part_number_id;
                $gauge->revision_number = $revision_number;
                $gauge->revision_date = $revision_date;
                $gauge->application = $application;
                $gauge->customer_id = $customer_id;
                $gauge->product_description = $product_description;
                $gauge->stage = $stage;
                $gauge->gauge_number = $gauge_number[$key];
                $gauge->to_check = $to_check[$key];
                $gauge->sample_size = $sample_size[$key];
                $gauge->frequency = $frequency[$key];
                $file = $photo[$key];
                $fileName = time().'_'.$file->getClientOriginalName();
                $timing_plan = APQPTimingPlan::find($apqp_timing_plan_id);
                $location = $timing_plan->apqp_timing_plan_number.'/gauge_equipment';
                if (! File::exists($location)) {
                    File::makeDirectory(public_path().'/'.$location,0777,true);
                }
                $file->move($location,$fileName);
                $gauge->photo = $fileName;
                $gauge->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 1;
            $plan->current_sub_stage_id = 8;
            $plan->status_id = 2;
            $plan->update();

            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',8)->first();
            $plan_activity->actual_start_date = Carbon::now();
            $plan_activity->prepared_by = auth()->user()->id;
            $plan_activity->prepared_at = Carbon::now();
            $plan_activity->status_id = 2;
            $plan_activity->gyr_status = "Y";
            $plan_activity->update();
<<<<<<< HEAD

            // Mail Function
=======
<<<<<<< HEAD
            // $activity = APQPPlanActivity::find($plan_activity->id);
            // $user_email = auth()->user()->email;
            // $user_name = auth()->user()->name;
            // // Mail Function
            // $ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            // Mail::to('r.naveen@venkateswarasteels.com')
            // ->cc($cc_emails)
            // ->send(new ActivityMail($user_email,$user_name,$activity));
=======
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
        //    $ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            Mail::to('r.naveen@venkateswarasteels.com')
            // Mail::to('edp@venkateswarasteels.com')
           // ->cc($cc_emails)
            ->send(new ActivityMail($user_email,$user_name,$activity));
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
            DB::commit();
            return response()->json(['status'=>'200','message'=>'Gauge Equipments Created Successfully!']);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>500,'message' =>$th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $gauge = IdentificationOfGaugeEquipment::where('apqp_timing_plan_id',$id)->first();
        $location = $gauge->timing_plan->apqp_timing_plan_number.'/gauge_equipment/';
        // dd($location);
        $gaugeequipments=IdentificationOfGaugeEquipment::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',8)->get();
        return view('apqp.gauge_equipment.view',compact('plan','plans','part_numbers','customers','customer_types','gaugeequipments','location'));

<<<<<<< HEAD
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $gauge = IdentificationOfGaugeEquipment::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $gauge->timing_plan->apqp_timing_plan_number.'/gauge_equipment/';
        // dd($location);
        $gaugeequipments=IdentificationOfGaugeEquipment::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        return view('apqp.gauge_equipment.view',compact('plan','plans','part_numbers','customers','customer_types','gaugeequipments','location'));

=======
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationOfGaugeEquipment $identificationOfGaugeEquipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationOfGaugeEquipmentRequest  $request
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentificationOfGaugeEquipmentRequest $request, IdentificationOfGaugeEquipment $identificationOfGaugeEquipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationOfGaugeEquipment  $identificationOfGaugeEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationOfGaugeEquipment $identificationOfGaugeEquipment)
    {
        //
    }
}
