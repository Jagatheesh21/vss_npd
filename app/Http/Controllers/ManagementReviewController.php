<?php

namespace App\Http\Controllers;

use App\Models\ManagementReview;
use App\Http\Requests\StoreManagementReviewRequest;
use App\Http\Requests\UpdateManagementReviewRequest;

class ManagementReviewController extends Controller
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
     * @param  \App\Http\Requests\StoreManagementReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManagementReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function show(ManagementReview $managementReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ManagementReview $managementReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateManagementReviewRequest  $request
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManagementReviewRequest $request, ManagementReview $managementReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagementReview  $managementReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManagementReview $managementReview)
    {
        //
    }
}
