<?php

namespace App\Http\Controllers;

use App\Models\PtrSignoff;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Requests\StorePtrSignoffRequest;
use App\Http\Requests\UpdatePtrSignoffRequest;

class PtrSignoffController extends Controller
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
        return view('apqp.ptr_signoff.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePtrSignoffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePtrSignoffRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PtrSignoff  $ptrSignoff
     * @return \Illuminate\Http\Response
     */
    public function show(PtrSignoff $ptrSignoff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PtrSignoff  $ptrSignoff
     * @return \Illuminate\Http\Response
     */
    public function edit(PtrSignoff $ptrSignoff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePtrSignoffRequest  $request
     * @param  \App\Models\PtrSignoff  $ptrSignoff
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePtrSignoffRequest $request, PtrSignoff $ptrSignoff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PtrSignoff  $ptrSignoff
     * @return \Illuminate\Http\Response
     */
    public function destroy(PtrSignoff $ptrSignoff)
    {
        //
    }
}
