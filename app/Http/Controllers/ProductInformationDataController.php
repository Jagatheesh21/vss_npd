<?php

namespace App\Http\Controllers;

use App\Models\ProductInformationData;
use App\Models\APQPTimingPlan;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Http\Requests\StoreProductInformationDataRequest;
use App\Http\Requests\UpdateProductInformationDataRequest;
use Illuminate\Http\Request;


class ProductInformationDataController extends Controller
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
        return view('apqp.product_information.create',compact('plan','plans','part_numbers','customers','customer_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductInformationDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductInformationDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductInformationData  $productInformationData
     * @return \Illuminate\Http\Response
     */
    public function show(ProductInformationData $productInformationData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductInformationData  $productInformationData
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductInformationData $productInformationData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductInformationDataRequest  $request
     * @param  \App\Models\ProductInformationData  $productInformationData
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductInformationDataRequest $request, ProductInformationData $productInformationData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductInformationData  $productInformationData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInformationData $productInformationData)
    {
        //
    }
}
