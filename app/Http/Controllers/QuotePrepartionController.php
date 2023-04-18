<?php

namespace App\Http\Controllers;

use App\Models\QuotePrepartion;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\PartNumber;
use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\StoreQuotePrepartionRequest;
use App\Http\Requests\UpdateQuotePrepartionRequest;
use Illuminate\Http\Request;
use App\Mail\ActivityMail;
use Mail;
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
    public function create(Request $request)
    {
        $id = $request->id;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();


        return view('apqp.quote_preparation.create',compact('plan','plans','part_numbers','customers','customer_types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuotePrepartionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuotePrepartionRequest $request)
    {
   try {

            $quote = new QuotePrepartion;
            $quote->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $quote->stage_id = 1;
            $quote->sub_stage_id = 5;
            $quote->part_number_id = $request->part_number_id;
            $quote->revision_number = $request->revision_number;
            $quote->revision_date = $request->revision_date;
            $quote->application = $request->application;
            $quote->customer_id = $request->customer_id;
            $quote->status_id = 2;
            $quote->product_description = $request->product_description;
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',5)->first();
            $file = $request->file('quote_document');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $plan_activity->plan->apqp_timing_plan_number.'/quote_preparation';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            $quote->quote_document = $fileName;
            $quote->remarks = $request->remarks??NULL;
            $quote->save();
            // Update Timing Plan Current Activity
            $plan = APQPTimingPlan::find($request->apqp_timing_plan_id);
            $plan->current_stage_id = 1;
            $plan->current_sub_stage_id = 5;
            $plan->status_id = 2;
            $plan->update();

            // Update Activity
            $plan_activity = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',5)->first();
            $plan_activity->actual_start_date = Carbon::now();
            $plan_activity->prepared_by = auth()->user()->id;
            $plan_activity->prepared_at = Carbon::now();
            $plan_activity->status_id = 2;
            $plan_activity->gyr_status = "Y";
            $plan_activity->update();

            // Mail
            $activity = APQPPlanActivity::find($plan_activity->id);
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            // Mail Function
<<<<<<< HEAD
            // $ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            Mail::to('edp@venkateswarasteels.com')
            ->cc($cc_emails)
=======
           // $ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            Mail::to('r.naveen@venkateswarasteels.com')
            // Mail::to('edp@venkateswarasteels.com')
            //->cc($cc_emails)
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
            ->send(new ActivityMail($user_email,$user_name,$activity));
            return back()->withSuccess('Quote Preparation Created Successfully!');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors($th->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuotePrepartion  $quotePrepartion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $id = $request->id;
        $plan = APQPTimingPlan::find($id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
<<<<<<< HEAD
        $quote_preparation = QuotePrepartion::where('apqp_timing_plan_id',$id)->first();
        $location = $quote_preparation->timing_plan->apqp_timing_plan_number.'/quote_preparation/';
        $quoteprepartion = QuotePrepartion::with('timing_plan')->where('apqp_timing_plan_id', $id)->where('sub_stage_id',5)->get();
        // dd($quoteprepartion->timing_plan);
        return view('apqp.quote_preparation.view',compact('plan','plans','part_numbers','customers','customer_types','quoteprepartion','location'));
=======
        $quoteprepartion = QuotePrepartion::with('timing_plan')->find($id);
        // dd($quoteprepartion->timing_plan);
        return view('apqp.quote_preparation.view',compact('plan','plans','part_numbers','customers','customer_types','quoteprepartion'));
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026

    }
    // public function download($quote_document)
    // {
    //     // $file = material::where('uuid',$uuid)->first();
    //     $pathofFile = storage_path($quote_document);
    //     return response()->download($pathofFile);
    // }


    public function preview($plan_id,$sub_stage_id)
    {
        // $id = $request->id;
        $plan = APQPTimingPlan::find($plan_id);
        $plans = APQPTimingPlan::get();
        $part_numbers = PartNumber::get();
        $customer_types = CustomerType::get();
        $customers = Customer::get();
        $quote_preparation = QuotePrepartion::where('apqp_timing_plan_id',$plan_id)->first();
        $location = $quote_preparation->timing_plan->apqp_timing_plan_number.'/quote_preparation/';
        $quoteprepartion = QuotePrepartion::with('timing_plan')->where('apqp_timing_plan_id', $plan_id)->where('sub_stage_id',$sub_stage_id)->get();
        // dd($quoteprepartion->timing_plan);
        return view('apqp.quote_preparation.view',compact('plan','plans','part_numbers','customers','customer_types','quoteprepartion','location'));

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
