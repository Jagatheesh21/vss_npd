<?php

namespace App\Http\Controllers;

use App\Models\EnquiryRegister;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\PartNumber;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use Auth;
use App\Http\Requests\StoreEnquiryRegisterRequest;
use App\Http\Requests\UpdateEnquiryRegisterRequest;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;
use Carbon\Carbon;
use App\Mail\EnquiryRegisterMail;
use Mail;
class EnquiryRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = APQPPlanActivity::with(['plan','plan.part_number','plan.customer'])->where('responsibility',auth()->user()->id)->where('sub_stage_id',1)->where('status_id',1)->get();
      
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="'.route('enquiry_register.edit',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Update</a>';               
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                    }
        
        return view('apqp.enquiry_register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_email = auth()->user()->email;
        $user_name = auth()->user()->name;
        $file = public_path('TP20231\enquiry_register\1677306082_rcinv.txt');
        $enquiry = EnquiryRegister::find(1);
        Mail::to('edp@venkateswarasteels.com')->send(new EnquiryRegisterMail($user_email,$user_name,$file,$enquiry));

        // $id = $request->id;
        // $customers = Customer::with('customer_type')->get();
        // $part_numbers = PartNumber::all();
        // $customer_types = CustomerType::all();
        // $timing_plans = APQPTimingPlan::all();
        // $plan = APQPPlanActivity::with(['plan','plan.customer','plan.customer.customer_type'])->find($id);
        // return view('apqp.enquiry_register.create',compact('timing_plans','plan','customer_types','customers','part_numbers'));

        // $customers = Customer::all();
        // $part_numbers = PartNumber::all();
        // $plans = APQPPlanActivity::with('plan','plan.customer','plan.customer.customer_type')->where('responsibility',auth()->user()->id)->where('sub_stage_id',1)->where('status_id',1)->get();
        // return view('apqp.enquiry_register.create',compact('plans','customers','part_numbers'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEnquiryRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnquiryRegisterRequest $request)
    {
       
        DB::beginTransaction();
        try {
            //EnquiryRegister::create($request->validated());
            $enquiry_register = new EnquiryRegister;
            $enquiry_register->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $enquiry_register->stage_id = 1;
            $enquiry_register->sub_stage_id = 1;
            $enquiry_register->received_date = $request->received_date;
            $enquiry_register->enquiry_type = $request->type_of_enquiry;
            if($req->file()) {

                $fileName = time().'_'.$req->file->getClientOriginalName();
                $filePath = $req->file('enquiry_document')->storeAs('uploads', $fileName, 'public');
            }
            $enquiry_register->enquiry_document = $fileName;
            
            $enquiry_register->save();
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            $file = $filepath;
            $enquiry = EnquiryRegister::find($enquiry_register->id);
            Mail::to('edp@venkateswarasteels.com')->send(new EnquiryRegisterMail($user_email,$user_name,$file,$enquiry));
            
            $plan = APQPPlanActivity::where('apqp_timing_plan_id',$apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',1)->first();
            $plan->status_id = 4;
            $plan->gyr_status = 'G';
            $plan->update();
            $data["email"] = "edp@venakteswarasteels.com";
           $data["title"] = "Enquiry Register Approval";
           
           
           
        //   Mail::send('email.welcome', $data, function($message)use($data, $file) {
        //     $message->to($data["email"])
        //             ->subject($data["title"])
        //             ->attach($file);
        //     });
           DB::commit();
           
            return response('success');
        } catch (\Throwable $th) {
            //throw $th;
           DB::rollback();
            return response($th->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('test');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::with('customer_type')->get();
        $part_numbers = PartNumber::all();
        $customer_types = CustomerType::all();
        $timing_plans = APQPTimingPlan::all();
        $plan = APQPPlanActivity::with(['plan','plan.customer','plan.customer.customer_type'])->find($id);
        return view('apqp.enquiry_register.edit',compact('timing_plans','plan','customer_types','customers','part_numbers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnquiryRegisterRequest  $request
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnquiryRegisterRequest $request, EnquiryRegister $enquiryRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnquiryRegister $enquiryRegister)
    {
        //
    }
    public function save_register(Request $request)
    {
            $validated = $request->validate([
                'received_date' => 'required',
                'average_annum_demand' => 'required',
                'enquiry_document' => 'required|mimes:csv,txt,xlx,xls,pdf,jpg,png,PNG|max:2048',
                'type_of_enquiry' => 'required'
            ]);
            $enquiry_register = new EnquiryRegister;
            $enquiry_register->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $enquiry_register->stage_id = 1;
            $enquiry_register->sub_stage_id = 1;
            $enquiry_register->received_date = $request->received_date;
            $enquiry_register->enquiry_type = $request->type_of_enquiry;
            $plan = APQPPlanActivity::where('apqp_timing_plan_id',$request->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',1)->first();            
            $file = $request->file('enquiry_document');
            $fileName = time().'_'.$file->getClientOriginalName();            
            $location = $plan->plan->apqp_timing_plan_number.'/enquiry_register';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            $enquiry_register->enquiry_document = $fileName;
            $enquiry_register->save();
            
            $plan->actual_start_date = Carbon::now();
            $plan->actual_end_date = Carbon::now();
            $plan->status_id = 4;
            $plan->gyr_status = "G";
            $plan->update();
            //return response();
            return redirect(route('activity.index'))->withSuccess('Enquiry Register Updated Successfully!');        
    }
}
