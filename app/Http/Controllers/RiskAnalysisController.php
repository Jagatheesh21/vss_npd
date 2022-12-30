<?php

namespace App\Http\Controllers;

use App\Models\RiskAnalysis;
use App\Http\Requests\StoreRiskAnalysisRequest;
use App\Http\Requests\UpdateRiskAnalysisRequest;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRiskAnalysisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskAnalysisRequest $request)
    {
        //
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
