<?php

namespace App\Http\Controllers;

use App\Models\QuotePrepartion;
use App\Http\Requests\StoreQuotePrepartionRequest;
use App\Http\Requests\UpdateQuotePrepartionRequest;

class QuotePrepartionController extends Controller
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
     * @param  \App\Http\Requests\StoreQuotePrepartionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuotePrepartionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuotePrepartion  $quotePrepartion
     * @return \Illuminate\Http\Response
     */
    public function show(QuotePrepartion $quotePrepartion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuotePrepartion  $quotePrepartion
     * @return \Illuminate\Http\Response
     */
    public function edit(QuotePrepartion $quotePrepartion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuotePrepartionRequest  $request
     * @param  \App\Models\QuotePrepartion  $quotePrepartion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuotePrepartionRequest $request, QuotePrepartion $quotePrepartion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuotePrepartion  $quotePrepartion
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuotePrepartion $quotePrepartion)
    {
        //
    }
}
