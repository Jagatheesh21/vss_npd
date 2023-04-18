<?php

namespace App\Http\Controllers;

use App\Models\APQPPLanActivity;
use App\Http\Requests\StoreAPQPPLanActivityRequest;
use App\Http\Requests\UpdateAPQPPLanActivityRequest;
use DataTables;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use App\Exports\EscalationActivity;
use Maatwebsite\Excel\Facades\Excel;
Use Mail;
use App\Mail\EscalationMail;
use Illuminate\Support\Facades\Storage;
class APQPPLanActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(auth()->user()->id>7)
        {
            if($request->ajax()){

                $data = APQPPlanActivity::with(['plan','plan.part_number','plan.customer','sub_stage'])->where('responsibility',auth()->user()->id)->where('status_id',1)->GroupBy('apqp_timing_plan_id')->get();
                    return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $url = url('activity/task_list?id=');
                                $btn = '<a href="'.$url.$row->plan->id.'" data-toggle="tooltip"  data-id="'.$row->plan->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Tasks</a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
                        }

        }
        if(auth()->user()->id==7)
        {
            if($request->ajax()){

                $data = APQPPlanActivity::with(['plan','plan.part_number','plan.customer','sub_stage'])->where('verified_by',auth()->user()->id)->where('status_id',2)->GroupBy('apqp_timing_plan_id')->get();
                    return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $url = url('activity/task_list?id=');
                                $btn = '<a href="'.$url.$row->plan->id.'" data-toggle="tooltip"  data-id="'.$row->plan->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Tasks</a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
                        }

        }
        if(auth()->user()->id==3 || auth()->user()->id==5 || auth()->user()->id==6)
        {
            if($request->ajax()){

                $data = APQPPlanActivity::with(['plan','plan.part_number','plan.customer','sub_stage'])->where('approved_by',auth()->user()->id)->where('status_id',3)->GroupBy('apqp_timing_plan_id')->get();
                    return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $url = url('activity/task_list?id=');
                                $btn = '<a href="'.$url.$row->plan->id.'" data-toggle="tooltip"  data-id="'.$row->plan->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Tasks</a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
                        }

        }

        return view('apqp.activity.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = APQPPlanActivity::with(['plan','plan.part_number','plan.customer'])->where('responsibility',auth()->user()->id)->where('status_id',1)->get();
        dd($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAPQPPLanActivityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAPQPPLanActivityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\APQPPLanActivity  $aPQPPLanActivity
     * @return \Illuminate\Http\Response
     */
    public function show(APQPPLanActivity $aPQPPLanActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\APQPPLanActivity  $aPQPPLanActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(APQPPLanActivity $aPQPPLanActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAPQPPLanActivityRequest  $request
     * @param  \App\Models\APQPPLanActivity  $aPQPPLanActivity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAPQPPLanActivityRequest $request, APQPPLanActivity $aPQPPLanActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\APQPPLanActivity  $aPQPPLanActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(APQPPLanActivity $aPQPPLanActivity)
    {
        //
    }
    public function getActivityStatus(Request $request)
    {
        if($request->activity_id)
        {
            $activity_id = $request->activity_id;
            $plan = APQPPLanActivity::find($activity_id);
            // if(($plan->sub_stage_id)>1)
            // {
            //     $prev = ($plan->sub_stage_id)-1;
            //     $prev_plan = APQPPLanActivity::where('apqp_timing_plan_id',$plan->apqp_timing_plan_id)->where('sub_stage_id',$prev)->first();
            //     $prev_
            // }
        }
    }
    public function escalation_activity(Request $request)
    {
        if ($request->ajax()) {
            $data = APQPPLanActivity::with('plan','plan.part_number','plan.customer','stage','sub_stage','plan.status')->upcoming()->get();
             return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('apqp.activity.escalation');
    }
    public function escalation_export()
    {
        $date = Carbon::now();
        $formattedDate = $date->format('Y-m-d');
        $path = 'escalation/'.$formattedDate.'_activities.xlsx';
        $file = Excel::store(new EscalationActivity(2018), $path);
        $username = auth()->user()->name;
        $email = "edp@venakteswarasteels.com";
        Mail::to($email)->send(new EscalationMail($username,Storage::get($path)));

   }

   public function task_list(Request $request)
   {
        $plan_id = $request->input('id');
        $tasks = APQPPLanActivity::with('plan','plan.part_number','plan.customer','stage','sub_stage','plan.status')->where('apqp_timing_plan_id',$plan_id);
        $user_id = auth()->user()->id;
        if($user_id>7)
        {
            $tasks = $tasks->where('responsibility',auth()->user()->id)->where('status_id',1);
        }
        if($user_id==7)
        {
            $tasks = $tasks->where('verified_by',auth()->user()->id)->where('status_id',2);
        }
        if($user_id==3 || $user_id==5 || $user_id==6 )
        {
            $tasks = $tasks->where('approved_by',auth()->user()->id)->where('status_id',3);
        }
        $task_lists = $tasks->get();
        return view('apqp.tasks.index',compact('task_lists'));

    }
}
