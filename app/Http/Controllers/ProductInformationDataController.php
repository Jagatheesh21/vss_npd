<?php

namespace App\Http\Controllers;

use App\Models\ProductInformationData;
use App\Http\Requests\StoreProductInformationDataRequest;
use App\Http\Requests\UpdateProductInformationDataRequest;

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
    public function create()
    {
        //
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
