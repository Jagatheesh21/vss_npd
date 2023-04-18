<?php

namespace App\Http\Controllers;

use App\Models\IdentificationOfSpecialCharacteristic;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreIdentificationOfSpecialCharacteristicRequest;
use App\Http\Requests\UpdateIdentificationOfSpecialCharacteristicRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Auth;
use Mail;
use App\Mail\ActivityMail;
class IdentificationOfSpecialCharacteristicController extends Controller
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
        return view('apqp.special_characteristics.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdentificationOfSpecialCharacteristicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentificationOfSpecialCharacteristicRequest $request)
    {
        // DB::beginTransaction();
        try {
            $grid_notes = $request->input('grid_notes');
            $description = $request->input('description');
            $specification = $request->input('specification');
            $instrument = $request->input('instrument');
            $remarks = $request->input('remarks');
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',7)->first();
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/special_characteristics';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            foreach($grid_notes as $key=>$notes)
            {
                $special = new IdentificationOfSpecialCharacteristic;
                $special->apqp_timing_plan_id = $apqp_timing_plan_id;
                $special->stage_id = 1;
                $special->sub_stage_id = 7;
                $special->part_number_id = $part_number_id;
                $special->revision_number = $revision_number;
                $special->revision_date = $revision_date;
                $special->application = $application;
                $special->customer_id = $customer_id;
                $special->product_description = $product_description;
                $special->file = $fileName;
                $special->grid_notes = $notes;
                $special->description = $description[$key];
                $special->specification = $specification[$key];
                $special->instrument = $instrument[$key];
                $special->remarks = $remarks[$key];
                $special->prepared_by = auth()->user()->id;
                $special->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 1;
            $plan->current_sub_stage_id = 7;
            $plan->status_id = 2;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',7)->first();
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
            // Mail::to('edp@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
            DB::commit();
            return response()->json(['status'=>'200','message'=>'Special Characteristics Created Successfully!']);

        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return response()->json(['status'=>'500','message'=>$th->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $special_characteristics = IdentificationOfSpecialCharacteristic::where('apqp_timing_plan_id',$id)->first();
        $location = $special_characteristics->timing_plan->apqp_timing_plan_number.'/special_characteristics/';
        $special_characters=IdentificationOfSpecialCharacteristic::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',7)->get();
        return view('apqp.special_characteristics.view',compact('plan','plans','part_numbers','customers','customer_types','special_characters','location'));
    }

    public function preview($plan_id,$sub_stage_id)
    {
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $special_characteristics = IdentificationOfSpecialCharacteristic::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $special_characteristics->timing_plan->apqp_timing_plan_number.'/special_characteristics/';
        $special_characters=IdentificationOfSpecialCharacteristic::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        return view('apqp.special_characteristics.view',compact('plan','plans','part_numbers','customers','customer_types','special_characters','location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationOfSpecialCharacteristic $identificationOfSpecialCharacteristic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationOfSpecialCharacteristicRequest  $request
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentificationOfSpecialCharacteristicRequest $request, IdentificationOfSpecialCharacteristic $identificationOfSpecialCharacteristic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationOfSpecialCharacteristic  $identificationOfSpecialCharacteristic
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationOfSpecialCharacteristic $identificationOfSpecialCharacteristic)
    {
        //
    }
}
