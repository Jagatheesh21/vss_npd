<?php

namespace App\Http\Controllers;

use App\Models\PreLaunchControlPlan;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StorePreLaunchControlPlanRequest;
use App\Http\Requests\UpdatePreLaunchControlPlanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use App\Mail\ActivityMail;
class PreLaunchControlPlanController extends Controller
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
        $users = User::where('id','>',1)->get();
        return view('apqp.prelaunch_control_plan.create',compact('plan','plans','part_numbers','customers','customer_types','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreLaunchControlPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreLaunchControlPlanRequest $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $control_plan_number = $request->input('control_plan_number');
            $key_contact = $request->input('key_contact');
            $control_plan_type = $request->input('control_plan_type');
            $document_number = $request->input('document_number');
            $part_number_id = $request->input('part_number_id');
            $revision_number = $request->input('revision_number');
            $revision_date = $request->input('revision_date');
            $application = $request->input('application');
            $customer_id = $request->input('customer_id');
            $product_description = $request->input('product_description');
            $core_team = $request->input('core_team');
            $model_reference = $request->input('model_reference');
            $supplier_plant_approval_date = $request->input('supplier_plant_approval_date');
            $customer_engineer_approval_date = $request->input('customer_engineer_approval_date');
            $other_approval_date = $request->input('other_approval_date');
            $material_specification_norms = $request->input('material_specification_norms');
            $process_seq_nos = $request->input('process_seq_no');
            $tools_for_manufacturing = $request->input('tools_for_manufacturing');
            $s_no = $request->input('s_no');
            $product = $request->input('product');
            $material_grade = $request->input('material_grade');
            $special_character = $request->input('special_character');
            $process_specification = $request->input('process_specification');
            $measurement_technique = $request->input('measurement_technique');

            $size = $request->input('size');
            $frequency = $request->input('frequency');
            $control_method = $request->input('control_method');
            $responsiblity = $request->input('responsiblity');
            $reaction_plan = $request->input('reaction_plan');
            $data = array();
            foreach ($process_seq_nos as $key => $process_seq_no) {
                $proto = new PreLaunchControlPlan;
                $proto->control_plan_number = $control_plan_number;
                $proto->key_contact = $key_contact;
                $proto->control_plan_type = $control_plan_type;
                $proto->document_number = $document_number;
                $proto->core_team = json_encode($core_team);
                $proto->model_reference = $model_reference;
                $proto->supplier_plant_approval_date = $supplier_plant_approval_date;
                $proto->customer_engineer_approval_date = $customer_engineer_approval_date;
                $proto->other_approval_date = $other_approval_date;
                $proto->material_specification_norms = $material_specification_norms;
                $proto->apqp_timing_plan_id = $apqp_timing_plan_id;
                $proto->stage_id = 2;
                $proto->sub_stage_id = 16;
                $proto->part_number_id = $part_number_id;
                $proto->revision_number = $revision_number;
                $proto->revision_date = $revision_date;
                $proto->customer_id = $customer_id;
                $proto->application = $application;
                $proto->product_description = $product_description;
                $proto->process_seq_no = $process_seq_no;
                $proto->tools_for_manufacturing = $tools_for_manufacturing[$key];
                $proto->s_no = $s_no[$key];
                $proto->product = $product[$key];
                $proto->material_grade = $material_grade[$key];
                $proto->special_character = $special_character[$key];
                $proto->process_specification = $process_specification[$key];
                $proto->measurement_technique = $measurement_technique[$key];
                $proto->size = $size[$key];
                $proto->frequency = $frequency[$key];
                $proto->control_method = $control_method[$key];
                $proto->responsiblity = $responsiblity[$key];
                $proto->reaction_plan = $reaction_plan[$key];
                $proto->save();
            }
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($apqp_timing_plan_id);
            $plan->current_stage_id = 2;
            $plan->current_sub_stage_id = 16;
            $plan->update();
            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',2)->where('sub_stage_id',16)->first();
            $plan_activity->status_id = 2;
            $plan_activity->actual_start_date = date('Y-m-d');
            $plan_activity->prepared_at = Carbon::now();
            $plan_activity->gyr_status = 'P';
            $plan_activity->update();
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // Mail Function
            Mail::to('r.naveen@venkateswarasteels.com')->send(new ActivityMail($user_email,$user_name,$activity));
         DB::commit();
        return response()->json(['status'=>200,'message'=>'ProtoContolPlan Created Successfully!']);
        } catch (\Throwable $th) {
        //     //throw $th;
         DB::rollback();
            return response()->json(['status'=>500,'message'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function show(PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreLaunchControlPlanRequest  $request
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreLaunchControlPlanRequest $request, PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreLaunchControlPlan  $preLaunchControlPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreLaunchControlPlan $preLaunchControlPlan)
    {
        //
    }
}
