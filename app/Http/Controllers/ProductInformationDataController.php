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
        
        try {
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
            $product = new ProductInformationData;
            $product->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $product->stage_id = 1;
            $product->sub_stage_id = 2;
            $product->customer_id = $request->customer_id;
            $product->application = $request->application;
            $product->product_description = $request->product_description;
            $product->revision_number = $request->revision_number;
            $product->customer_po_reference = $request->customer_po_reference;
            $product->price = $request->price;
            $product->delivery_commencement_date = $request->delivery_commencement_date;
            $product->volume_requirements = $request->volume_requirements;
            $product->special_characteristics = $request->special_characteristics;
            $product->cpk_ppk_requirements = $request->cpk_ppk_requirements;
            $product->customer_requirements = $request->customer_requirements;
            $product->list_of_new_equipments = $request->list_of_new_equipments;
            $product->part_approval_requirement = $request->part_approval_requirement;
            $product->proto_type_build_requirement = $request->proto_type_build_requirement;
            $product->labeling_requirement = $request->labeling_requirement;
            $product->product_traceability_requirement = $request->product_traceability_requirement;
            $product->other_requirement = $request->other_requirement;
            $product->experience_of_previous_development = $request->experience_of_previous_developement;
            $product->brought_out_parts = $request->details_of_brought_out_part;
            $product->sub_contract_process = $request->details_of_subcontract_process;
            $product->preliminary_process_flow = $request->process_flow;
            $product->prepared_by = auth()->user()->id;
            $product->prepared_at = now();
            $product->save();
            return back()->withSuccess('Product Information Data Created Successfully!');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
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
