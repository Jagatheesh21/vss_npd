<?php

namespace App\Http\Controllers;

use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\User;
use App\Models\PartNumber;
use App\Models\Stage;
use App\Models\SubStage;
use App\Http\Requests\StoreAPQPTimingPlanRequest;
use App\Http\Requests\UpdateAPQPTimingPlanRequest;
use App\Http\Requests\StoreAPQPPLanActivityRequest;
use App\Http\Requests\UpdateScheduler;
use DataTables;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Exports\TimingPlanExport;
use Maatwebsite\Excel\Facades\Excel;


class APQPTimingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if($request->ajax()){
            $data = APQPTimingPlan::with(['stage','sub_stage','part_number','customer'])->latest()->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){

                            $btn = '<a href="'.route('apqp_timing_plan.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                            $btn = '<a href="'.route('apqp_timing_plan.show',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm viewPlan">Details</a>';

                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
        return view('apqp.timing_plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer_types = CustomerType::all();
        $customers = Customer::all();
        $part_numbers = PartNumber::all();
        $max_id = APQPTimingPlan::max('id')??0;
        $plan_number = 'TP'.date('Y').$max_id+1;
        $stages = Stage::with('sub_stages')->get();
        return view('apqp.timing_plan.create',compact('customer_types','customers','stages','plan_number','part_numbers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAPQPTimingPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAPQPTimingPlanRequest $request)
    {
        DB::beginTransaction();
        try {
            $plan = APQPTimingPlan::create($request->validated(),['current_stage_id'=>1,'current_sub_stage_id'=>1]);
            $activities = $request->input('status');
            $sub_stage = $request->input('sub_stage_id');
            $stage = $request->input('stage_id');
            foreach ($activities as $key => $activity) {
                $substage = SubStage::find($activity);
                $plan_activity = new APQPPlanActivity;
                $plan_activity->apqp_timing_plan_id = $plan->id;
                $plan_activity->stage_id = $substage->stage->id;
                $plan_activity->sub_stage_id = $activity;
                $plan_activity->status_id = 1;
                $plan_activity->save();
            }
            DB::commit();

            return back()->withSuccess('Timing Plan Created Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();

            return back()->withError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return \Illuminate\Http\Response
     */
    public function show(APQPTimingPlan $aPQPTimingPlan)
    {
        $plan = $aPQPTimingPlan;
        $customers = Customer::all();
        $part_numbers = PartNumber::all();
        $stages = Stage::with('sub_stages')->get();

        $timing = APQPTimingPlan::with(['stages','sub_stages','activites'])->find(9);
        return view('apqp.timing_plan.show',compact('plan','timing','customers','part_numbers','stages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(APQPTimingPlan $aPQPTimingPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAPQPTimingPlanRequest  $request
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAPQPTimingPlanRequest $request, APQPTimingPlan $aPQPTimingPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(APQPTimingPlan $aPQPTimingPlan)
    {
        //
    }
    public function plan_scheduler()
    {
        $customers = Customer::all();
        $part_numbers = PartNumber::all();
        return view('apqp.timing_plan.scheduler',compact('customers','part_numbers'));
    }
    public function getCustomers(Request $request)
    {
        $customer_type_id = $request->customer_type_id;
        $customers = Customer::select('id','name')->where('customer_type_id',$customer_type_id)->get();
        $html = view('apqp.timing_plan.customers',compact("customers"))->render();
        return response(['html' => $html]);
    }
    public function getPlans(Request $request)
    {
        $customer_id = $request->customer_id;
        $part_number_id = $request->part_number;
        $plans = APQPTimingPlan::select('id','apqp_timing_plan_number')->where('customer_id',$customer_id)->where('part_number_id',$part_number_id)->where('status_id',1)->get();
        return json_encode($plans);
    }
    public function getSchedulePlans(Request $request)
    {
        $customer_id = $request->customer_id;
        $part_number_id = $request->part_number;
        $plans = APQPTimingPlan::whereHas('activities', function($q)
        {
            $q->whereNull('plan_start_date');

        })->where('customer_id',$customer_id)->where('part_number_id',$part_number_id)->where('status_id',1)->get();

        return json_encode($plans);
    }
    public function getPlanActivities(Request $request)
    {
        $plan_id = $request->timing_plan_id;
        $sub_stages = APQPPlanActivity::with('sub_stage')->where('apqp_timing_plan_id',$plan_id)->get();
        $stages = APQPPlanActivity::with('stage')->where('apqp_timing_plan_id',$plan_id)->GroupBy('stage_id')->get();
        $users = User::where('id','>',4)->get();
        $html = view('apqp.timing_plan.schedule_activities',compact('sub_stages','stages','users'))->render();
        return response(['html' => $html]);
    }
    public function scheduler_update(StoreAPQPPLanActivityRequest $request)
    {
        DB::beginTransaction();
        try {
            $apqp_plan_id = $request->apqp_timing_plan_id;
            $activities = $request->input('id');
            $responsibility = $request->input('responsibility');
            $process_time = $request->input('process_time');
            $stage = $request->input('stage_id');
            $sub_stage = $request->input('sub_stage_id');
            $process_date = carbon::now();
            foreach($activities as $key=>$activity)
            {
                $plan_activity = APQPPlanActivity::find($activity);
                $plan_activity->process_time = $process_time[$key];
                $plan_activity->responsibility = $responsibility[$key];
                $process_start_date = Carbon::parse($process_date);
                $process_date = $process_start_date->addWeekdays($process_time[$key]);
                $plan_activity->plan_start_date = $process_date;
                $plan_activity->plan_end_date = $process_date;
                $plan_activity->update();

            }
            DB::commit();
            return redirect(route('apqp_timing_plan.index'))->withSuccess('Scheduler Added Successfully!');
            } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->withError($th->getMessage());
        }
        //dd($request->all());
        //DB::beginTransaction();
        // try {
        //     $apqp_plan_id = $request->apqp_timing_plan_id;
        //     $activities = $request->input('activity_id');
        //     $responsibility = $request->input('responsibility');
        //     $process_time = $request->input('process_time');
        //     $stage = $request->input('stage_id');
        //     $sub_stage = $request->input('sub_stage_id');
        //     $process_date = carbon::now();
        //     $data = array();
        //     foreach($activities as $key=>$activity)
        //     {
        //         $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_plan_id)->where('sub_stage_id',$sub_stage[$key])->first();
        //         $plan_activity->process_time = $process_time[$key];
        //         $plan_activity->responsibility = $responsibility[$key];
        //         $process_start_date = Carbon::parse($process_date);
        //         $process_date = $process_start_date->addWeekdays($process_time[$key]);
        //         $plan_activity->plan_start_date = $process_date;
        //         $plan_activity->plan_end_date = $process_date;
        //         $data = $plan_activity;
        //         //$plan_activity->update();
        //     }
        //     dd($data);
        //     // DB::commit();
        //     return redirect(route('apqp_timing_plan.index'))->withSuccess('Scheduler Added Successfully!');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     //DB::rollback();
        //     return back()->withError($th->getMessage());
        // }
    }
    public function export()
    {
        return Excel::download(new TimingPlanExport, 'timing_plan.xlsx');

    }
}
