<?php

namespace App\Http\Controllers;

use App\Models\APQPPLanActivity;
use App\Http\Requests\StoreAPQPPLanActivityRequest;
use App\Http\Requests\UpdateAPQPPLanActivityRequest;
use DataTables;
use Illuminate\Http\Request;
use Auth;
use DB;
class APQPPLanActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = APQPPlanActivity::with(['plan','plan.part_number','plan.customer','sub_stage'])->where('responsibility',auth()->user()->id)->where('status_id',1)->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="'.route('enquiry_register.create',['id'=>$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Update</a>';               
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
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
}
