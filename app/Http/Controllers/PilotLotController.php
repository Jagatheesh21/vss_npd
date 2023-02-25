<?php

namespace App\Http\Controllers;

use App\Models\PilotLot;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\User;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StorePilotLotRequest;
use App\Http\Requests\UpdatePilotLotRequest;

class PilotLotController extends Controller
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
        $users = User::where('id','>',1)->get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        return view('apqp.pilot_lot.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePilotLotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePilotLotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function show(PilotLot $pilotLot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function edit(PilotLot $pilotLot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePilotLotRequest  $request
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePilotLotRequest $request, PilotLot $pilotLot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PilotLot  $pilotLot
     * @return \Illuminate\Http\Response
     */
    public function destroy(PilotLot $pilotLot)
    {
        //
    }
}
