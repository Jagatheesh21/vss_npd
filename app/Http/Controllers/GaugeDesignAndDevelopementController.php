<?php

namespace App\Http\Controllers;

use App\Models\GaugeDesignAndDevelopement;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGaugeDesignAndDevelopementRequest;
use App\Http\Requests\UpdateGaugeDesignAndDevelopementRequest;

class GaugeDesignAndDevelopementController extends Controller
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
        return view('apqp.gauge_design.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGaugeDesignAndDevelopementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGaugeDesignAndDevelopementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function show(GaugeDesignAndDevelopement $gaugeDesignAndDevelopement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function edit(GaugeDesignAndDevelopement $gaugeDesignAndDevelopement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGaugeDesignAndDevelopementRequest  $request
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGaugeDesignAndDevelopementRequest $request, GaugeDesignAndDevelopement $gaugeDesignAndDevelopement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GaugeDesignAndDevelopement  $gaugeDesignAndDevelopement
     * @return \Illuminate\Http\Response
     */
    public function destroy(GaugeDesignAndDevelopement $gaugeDesignAndDevelopement)
    {
        //
    }
}
