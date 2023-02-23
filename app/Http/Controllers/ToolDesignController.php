<?php

namespace App\Http\Controllers;

use App\Models\ToolDesign;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreToolDesignRequest;
use App\Http\Requests\UpdateToolDesignRequest;

class ToolDesignController extends Controller
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
        return view('apqp.tool_design.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreToolDesignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreToolDesignRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToolDesign  $toolDesign
     * @return \Illuminate\Http\Response
     */
    public function show(ToolDesign $toolDesign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToolDesign  $toolDesign
     * @return \Illuminate\Http\Response
     */
    public function edit(ToolDesign $toolDesign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateToolDesignRequest  $request
     * @param  \App\Models\ToolDesign  $toolDesign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateToolDesignRequest $request, ToolDesign $toolDesign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToolDesign  $toolDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToolDesign $toolDesign)
    {
        //
    }
}
