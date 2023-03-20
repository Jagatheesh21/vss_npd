<?php

namespace App\Http\Controllers;

use App\Models\RiskAnalysis;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;

use App\Http\Requests\StoreRiskAnalysisRequest;
use App\Http\Requests\UpdateRiskAnalysisRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class RiskAnalysisController extends Controller
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
        return view('apqp.risk_analysis.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRiskAnalysisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskAnalysisRequest $request)
    {
        try {
            //code...
            RiskAnalysis::create($request->validated());
        } catch (\Throwable $th) {
            //throw $th;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function show(RiskAnalysis $riskAnalysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskAnalysis $riskAnalysis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskAnalysisRequest  $request
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskAnalysisRequest $request, RiskAnalysis $riskAnalysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskAnalysis  $riskAnalysis
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiskAnalysis $riskAnalysis)
    {
        //
    }
}
