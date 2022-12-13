<?php

namespace App\Http\Controllers;

use App\Models\APQPTimingPlan;
use App\Models\Customer;
use App\Models\PartNumber;
use App\Models\Stage;
use App\Models\SubStage;
use App\Http\Requests\StoreAPQPTimingPlanRequest;
use App\Http\Requests\UpdateAPQPTimingPlanRequest;
use DataTables;
use Illuminate\Http\Request;

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
            $data = APQPTimingPlan::with(['stage','sub_stage'])->latest()->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
       
                            // $btn = '<a href="'.route('apqp_timing_plan.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                            $btn = '<a href="'.route('apqp_timing_plan.view',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm viewPlan">Details</a>';
               
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
        $customers = Customer::all();
        $part_numbers = PartNumber::all();
        $max_id = APQPTimingPlan::max('id')??0;
        $plan_number = 'TP-'.date('Y').'-'.$max_id+1;
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
        try {
            dd($request->all());
            return back()->withSuccess($request->all());
        } catch (\Throwable $th) {
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
}
