<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use App\Http\Requests\StoreFlowProcessRequest;
use App\Http\Requests\UpdateFlowProcessRequest;

class FlowProcessController extends Controller
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
     * @param  \App\Http\Requests\StoreFlowProcessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFlowProcessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function show(FlowProcess $flowProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowProcess $flowProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFlowProcessRequest  $request
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFlowProcessRequest $request, FlowProcess $flowProcess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowProcess $flowProcess)
    {
        //
    }
}
