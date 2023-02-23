<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingFeasibilityReview;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;

use App\Http\Requests\StoreManufacturingFeasibilityReviewRequest;
use App\Http\Requests\UpdateManufacturingFeasibilityReviewRequest;
use Illuminate\Http\Request;

class ManufacturingFeasibilityReviewController extends Controller
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
        return view('apqp.mfr.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreManufacturingFeasibilityReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManufacturingFeasibilityReviewRequest $request)
    {
        try {
            //code...
            $ref_nos = $request->input('grid_ref_no');
            $pfds = $request->input('pfd');
            $parameters = $request->input('parameter_as_per_drawing');
            $specifications = $request->input('specification_as_per_drawing');
            $layouts = $request->input('initial_sample_layout_inspection');
            $past_troubles = $request->input('past_trouble');
            $mass_productions = $request->input('mass_production');
            $feasibility_confirmations = $request->input('feasibility_confirmation');
            $cpk_cmks = $request->input('cpk_cmk');
            $remark = $request->input('remarks');
            $apqp_timing_plan_id = $request->input('apqp_timing_plan_id');
            $stage_id = 1;
            $sub_stage_id = 3;
            foreach ($ref_nos as $key => $ref_no) {
                $mfr = new ManufacturingFeasibilityReview;
                $mfr->apqp_timing_plan_id = $request->apqp_timing_plan_id;  
                $mfr->stage_id = 1;  
                $mfr->sub_stage_id = 3;  
                $mfr->grid_notes = $ref_no;  
                $mfr->pfd_no = $pfds[$key];  
                $mfr->parameters_per_drawing = $parameters[$key];  
                $mfr->specification_per_drawing = $specifications[$key];  
                $mfr->initial_sample_layout_inspection = $layouts[$key];  
                $mfr->past_trouble = $past_troubles[$key];  
                $mfr->mass_production = $mass_productions[$key];  
                $mfr->feasibility_confirmation = $feasibility_confirmations[$key];  
                $mfr->cpk_cmk = $cpk_cmks[$key];  
                $mfr->remarks = $remark[$key];  
                $mfr->save();                                                                                             
            }
            return response()->json(['status'=>200,'message'=>'MFR Created Successfully!']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>500,'message'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function show(ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateManufacturingFeasibilityReviewRequest  $request
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufacturingFeasibilityReviewRequest $request, ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManufacturingFeasibilityReview  $manufacturingFeasibilityReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManufacturingFeasibilityReview $manufacturingFeasibilityReview)
    {
        //
    }
}
