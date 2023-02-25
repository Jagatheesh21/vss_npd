<?php

namespace App\Http\Controllers;

use App\Models\PpapPreparation;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\SubStage;
use App\Models\User;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StorePpapPreparationRequest;
use App\Http\Requests\UpdatePpapPreparationRequest;

class PpapPreparationController extends Controller
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
        return view('apqp.ppap_preparation.create',compact('plan','users','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePpapPreparationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePpapPreparationRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PpapPreparation  $ppapPreparation
     * @return \Illuminate\Http\Response
     */
    public function show(PpapPreparation $ppapPreparation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PpapPreparation  $ppapPreparation
     * @return \Illuminate\Http\Response
     */
    public function edit(PpapPreparation $ppapPreparation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePpapPreparationRequest  $request
     * @param  \App\Models\PpapPreparation  $ppapPreparation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePpapPreparationRequest $request, PpapPreparation $ppapPreparation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PpapPreparation  $ppapPreparation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PpapPreparation $ppapPreparation)
    {
        //
    }
}
