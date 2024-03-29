<?php

namespace App\Http\Controllers;

use App\Models\PtrSignoff;
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
use App\Http\Requests\StorePtrSignoffRequest;
use App\Http\Requests\UpdatePtrSignoffRequest;
use App\Mail\ActivityMail;
use Mail;

class PtrSignoffController extends Controller
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
        return view('apqp.ptr_signoff.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePtrSignoffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePtrSignoffRequest $request)
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
            $ptr_date = $request->input('ptr_date');
            $from_time = $request->input('from_time');
            $to_time = $request->input('to_time');
            $names = $request->input('name');
            $department = $request->input('department');
            $signature = $request->input('signature');
            $comments = $request->input('comments');
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',3)->where('sub_stage_id',27)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/ptr_signoff';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            foreach ($names as $key => $name) {
                $analysis = new PtrSignoff;
                $analysis->apqp_timing_plan_id = $apqp_timing_plan_id;
                $analysis->stage_id = 3;
                $analysis->sub_stage_id = 27;
                $analysis->part_number_id = $part_number_id;
                $analysis->revision_number = $revision_number;
                $analysis->revision_date = $revision_date;
                $analysis->customer_id = $customer_id;
                $analysis->application = $application;
                $analysis->ptr_date = $ptr_date;
                $analysis->from_time = $from_time;
                $analysis->to_time = $to_time;
                $analysis->name = $name;
                $analysis->department = $department[$key];
                $analysis->signature = $signature[$key];
                $analysis->comments = $comments;
                $analysis->file = $fileName;
                $analysis->prepared_by = auth()->user()->id;
                $analysis->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 3;
            $plan->current_sub_stage_id = 27;
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
            // Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            Mail::to('r.naveen@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));

            DB::commit();
            return response()->json(['status'=>200,'message'=>'PTR Signoff Created Successfully!']);

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>500,'message'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PtrSignoff  $ptrSignoff
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
        $ptr_signoff = PtrSignoff::where('apqp_timing_plan_id',$id)->first();
        $location = $ptr_signoff->timing_plan->apqp_timing_plan_number.'/ptr_signoff/';
        $ptr_signoff_data=PtrSignoff::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',27)->get();
        // echo "<pre>";
        // print_r($ptr_signoff_data);
        // echo "</pre>";
        // exit;
        return view('apqp.ptr_signoff.view',compact('plan','plans','part_numbers','customers','customer_types','ptr_signoff_data','location'));
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $users = User::where('id','>',1)->get();
        $customers = Customer::get();
        $ptr_signoff = PtrSignoff::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $ptr_signoff->timing_plan->apqp_timing_plan_number.'/ptr_signoff/';
        $ptr_signoff_data=PtrSignoff::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->get();
        // echo "<pre>";
        // print_r($ptr_signoff_data);
        // echo "</pre>";
        // exit;
        return view('apqp.ptr_signoff.view',compact('plan','plans','part_numbers','customers','customer_types','ptr_signoff_data','location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PtrSignoff  $ptrSignoff
     * @return \Illuminate\Http\Response
     */
    public function edit(PtrSignoff $ptrSignoff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePtrSignoffRequest  $request
     * @param  \App\Models\PtrSignoff  $ptrSignoff
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePtrSignoffRequest $request, PtrSignoff $ptrSignoff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PtrSignoff  $ptrSignoff
     * @return \Illuminate\Http\Response
     */
    public function destroy(PtrSignoff $ptrSignoff)
    {
        //
    }
}
