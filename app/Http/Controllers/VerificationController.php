<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnquiryRegister;
use App\Models\APQPPLanActivity;
use App\Models\APQPTimingPlan;
use App\Models\Customer;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\SubStage;
use Carbon\Carbon;
use Auth;
use App\Mail\VerificationMail;
use App\Mail\ApprovalMail;
use Illuminate\Support\Facades\DB;
use Mail;
class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = $request->input('model');
        $model = '\\App\\Models\\'.$model;

        dd($model::find(1));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required',
            'remarks' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $timing_plan_id = $request->apqp_timing_plan_id;
            $sub_stage_id = $request->sub_stage_id;
            $status = $request->status;
            $remarks = $request->remarks;
            $model = $request->model;

            // Timing Plan
            $plan = APQPTimingPlan::find($timing_plan_id);
            $plan->status_id = $status;
            $plan->update();
            // Activity
            $activity = APQPPLanActivity::where('apqp_timing_plan_id',$timing_plan_id)->where('sub_stage_id',$sub_stage_id)->first();
            $activity->status_id = $status;
            if($status==3)
            {
            $activity->verified_date = Carbon::now();
            }
            if($status==4)
            {
                $activity->approved_date = Carbon::now();
                $activity->actual_end_date = Carbon::now();
            }
            $activity->update();
            // Model
            $update = $model::where('apqp_timing_plan_id',$timing_plan_id)->first();
            $update->status = $status;
            if($status==3)
            {
            $update->verified_at = Carbon::now();
            }
            if($status==4)
            {
            $update->approved_at = Carbon::now();
            }
            $update->update();
            // Mail
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            $ccEmails = ['edp@venkatashwarasteels.com'];

            if(auth()->user()->id==7){
            Mail::to('edp@venkateswarasteels.com')
            ->cc($ccEmails)
            ->send(new VerificationMail($user_email,$user_name,$activity,$remarks));
            }
            if(auth()->user()->id==3 || auth()->user()->id==5 || auth()->user()->id==6){
                Mail::to('edp@venkateswarasteels.com')
                ->cc($ccEmails)
                ->send(new ApprovalMail($user_email,$user_name,$activity,$remarks));
                }
            DB::commit();
            return redirect(route('activity.index'))->withSuccess('Verification Activity Updated Successfully');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->withErrors($th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function task($plan_id,$sub_stage_id)
    {
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $sub_stage = SubStage::find($sub_stage_id);
        $timing_plans = APQPTimingPlan::get();
        $plan = APQPTimingPlan::find($plan_id);
        $sub_stages = SubStage::get();
        $model = '\\App\\Models\\'.$sub_stage->model;
        $url = $sub_stage->edit_url;
        $reference_id = $model::select('id')->where('apqp_timing_plan_id',$plan_id)->first();
        $activity = APQPPLanActivity::where('apqp_timing_plan_id',$plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        return view('apqp.verification.create',compact('plan','sub_stage','model','activity','part_numbers','customer_types','customers','timing_plans','sub_stage_id'));
    }
<<<<<<< HEAD
=======
    public function preview($plan_id,$sub_stage_id)
    {
        if ($sub_stage_id==1) {
        $customers = Customer::with('customer_type')->get();
        $part_numbers = PartNumber::all();
        $customer_types = CustomerType::all();
        $timing_plans = APQPTimingPlan::all();
        $sub_stage = SubStage::find($sub_stage_id);
        $plan = APQPTimingPlan::find($plan_id);
        $timing_plans = APQPTimingPlan::all();
        $model_data = '\\App\\Models\\'.$sub_stage->model;
        $activity = APQPPLanActivity::where('apqp_timing_plan_id',$plan_id)->where('sub_stage_id',$sub_stage_id)->first();
        $model= $model_data::with('timing_plan')->where('apqp_timing_plan_id',$plan_id)->first();
        $view ="apqp.".$activity->sub_stage->route.".view";
        // dd($model);
        return view($view,compact('model','customers','part_numbers','customer_types','plan','timing_plans'));
<<<<<<< HEAD

        }elseif ($sub_stage_id==2) {
           return 'hello';
        }elseif ($sub_stage_id==3) {
            $plan = APQPTimingPlan::find($plan_id);
            $plans = APQPTimingPlan::get();
            $part_numbers = PartNumber::get();
            $customer_types = CustomerType::get();
            $customers = Customer::get();
            $sub_stage = SubStage::find($sub_stage_id);
            $timing_plans = APQPTimingPlan::all();
            $model_data = '\\App\\Models\\'.$sub_stage->model;
            $mfr_data=APQPPLanActivity::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->first();
            $view ="apqp.".$mfr_data->sub_stage->route.".view";
            dd($model_data);
            return view($view,compact('plan','plans','part_numbers','customers','customer_types','mfr_data'));
        }
          }
=======
    }
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
}
