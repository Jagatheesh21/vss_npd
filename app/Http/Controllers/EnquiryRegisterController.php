<?php

namespace App\Http\Controllers;

use App\Models\EnquiryRegister;
use App\Models\Customer;
use App\Models\PartNumber;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use Auth;
use App\Http\Requests\StoreEnquiryRegisterRequest;
use App\Http\Requests\UpdateEnquiryRegisterRequest;
use DataTables;
use Illuminate\Http\Request;
use DB;


class EnquiryRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = APQPPlanActivity::with(['plan','plan.part_number','plan.customer'])->where('responsibility',auth()->user()->id)->where('sub_stage_id',1)->where('status_id',1)->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="'.route('enquiry_register.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Update</a>';               
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
        
        return view('apqp.enquiry_register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customers = Customer::all();
        $part_numbers = PartNumber::all();
        $plans = APQPPlanActivity::where('responsibility',auth()->user()->id)->where('sub_stage_id',1)->where('status_id',1)->get();
        return view('apqp.enquiry_register.create',compact('plans','customers','part_numbers'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEnquiryRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnquiryRegisterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('test');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $part_numbers = PartNumber::all();
        $timing_plans = APQPTimingPlan::all();
        $plan = APQPPlanActivity::with(['plan'])->find($id);
        return view('apqp.enquiry_register.edit',compact('timing_plans','plan','customers','part_numbers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnquiryRegisterRequest  $request
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnquiryRegisterRequest $request, EnquiryRegister $enquiryRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnquiryRegister $enquiryRegister)
    {
        //
    }
}
