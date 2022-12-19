<?php

namespace App\Http\Controllers;

use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\Customer;
use App\Models\User;
use App\Models\PartNumber;
use App\Models\Stage;
use App\Models\SubStage;
use App\Http\Requests\StoreAPQPTimingPlanRequest;
use App\Http\Requests\UpdateAPQPTimingPlanRequest;
use App\Http\Requests\UpdateScheduler;
use DataTables;
use Illuminate\Http\Request;
use DB;

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
                           // $btn = '<a href="'.route('apqp_timing_plan.view',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm viewPlan">Details</a>';
               
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
        // $structure = collect();
        // $master_menu_collection = APQPPlanActivity::where('stage_id', null)->get();
        // foreach ($master_menu_collection as $stage) {
        //     $structure->push($stage->getAll());
        // }

        // //dd($structure);
        $customers = Customer::all();
        $part_numbers = PartNumber::all();
        $max_id = APQPTimingPlan::max('id')??0;
        $plan_number = 'TP'.date('Y').$max_id+1;
        $stages = Stage::with('sub_stages')->get();
        return view('apqp.timing_plan.create',compact('customers','stages','plan_number','part_numbers'));
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
            $plan = APQPTimingPlan::create($request->validated());
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
        $timing = APQPTimingPlan::with(['stages','sub_stages','activites'])->find(1);
        dd($timing->stages);
        return view('apqp.timing_plan.show',compact('plan'));
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
    public function getPlans(Request $request)
    {
        $customer_id = $request->customer_id;
        $part_number_id = $request->part_number;
        $plans = APQPTimingPlan::select('id','apqp_timing_plan_number')->where('customer_id',$customer_id)->where('part_number_id',$part_number_id)->where('status_id',1)->get();
        return json_encode($plans);
    }
    public function getPlanActivities(Request $request)
    {
        $plan_id = $request->timing_plan_id;
        $stages = APQPPlanActivity::with('stage')->where('apqp_timing_plan_id',$plan_id)->GroupBy('stage_id')->get();
        $users = User::where('id','>',1)->get();
        $html = view('apqp.timing_plan.schedule_activities',compact('stages','users'))->render();
        return response(['html' => $html]);
    }
    public function scheduler_update(UpdateScheduler $request)
    {
        dd($request->all());
    }
}
