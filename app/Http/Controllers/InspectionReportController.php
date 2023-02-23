<?php

namespace App\Http\Controllers;

use App\Models\InspectionReport;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInspectionReportRequest;
use App\Http\Requests\UpdateInspectionReportRequest;

class InspectionReportController extends Controller
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
        return view('apqp.inspection_report.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInspectionReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInspectionReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function show(InspectionReport $inspectionReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function edit(InspectionReport $inspectionReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInspectionReportRequest  $request
     * @param  \App\Models\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInspectionReportRequest $request, InspectionReport $inspectionReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(InspectionReport $inspectionReport)
    {
        //
    }
}
