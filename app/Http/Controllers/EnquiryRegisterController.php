<?php

namespace App\Http\Controllers;

use App\Models\EnquiryRegister;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\PartNumber;
use App\Models\User;
use App\Models\Status;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use Auth;
use App\Http\Requests\StoreEnquiryRegisterRequest;
use App\Http\Requests\UpdateEnquiryRegisterRequest;
use \Yajra\Datatables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
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

        // $user_email = auth()->user()->email;
        // $user_name = auth()->user()->name;
        // $file = public_path('TP20231\enquiry_register\1677306082_rcinv.txt');
        // $enquiry = EnquiryRegister::find(1);
        // Mail::to('edp@venkateswarasteels.com')->send(new EnquiryRegisterMail($user_email,$user_name,$file,$enquiry));

        $id = $request->id;
        $customers = Customer::with('customer_type')->get();
        $part_numbers = PartNumber::all();
        $customer_types = CustomerType::all();
        $timing_plans = APQPTimingPlan::all();
        $plan = APQPTimingPlan::find($id);
        return view('apqp.enquiry_register.create',compact('timing_plans','plan','customer_types','customers','part_numbers'));

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

        //DB::beginTransaction();
        // try {
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
            $enquiry_register->prepared_by = auth()->user()->id;
            $enquiry_register->ern_sample = $request->ern_sample;
            $enquiry_register->sir_sample = $request->sir_sample;
            $enquiry_register->safe_launch_sample = $request->safe_launch_sample;
            $enquiry_register->save();

            $user_email = auth()->user()->email;
            //$user_email = 'edp@venkateswarasteels.com';
            $user_name = auth()->user()->name;
            $file = $filePath;
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
          // DB::commit();

            return response('success',$file);
        // } catch (\Throwable $th) {
        //     //throw $th;
        //    DB::rollback();
        //     return response($th->getMessage());

        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnquiryRegister  $enquiryRegister
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd('test');
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
        $statuses=Status::whereIn('id',[3,5])->get();
        $enquiry = EnquiryRegister::where('apqp_timing_plan_id',$id)->first();
        $plan = APQPPlanActivity::with(['plan','plan.customer','plan.customer.customer_type'])->find($id);
        $location = $enquiry->timing_plan->apqp_timing_plan_number.'/enquiry_register/';
        return view('apqp.enquiry_register.edit',compact('timing_plans','plan','customer_types','customers','part_numbers','statuses','enquiry','location'));
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
        $status_id = $request->input('status_id');
        $file = $request->file('enquiry_document');
        if($file)
        {
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = $enquiryRegister->timing_plan->apqp_timing_plan_number.'/enquiry_register';
            if (! File::exists($location)) {
                File::makeDirectory(public_path().'/'.$location,0777,true);
            }
            $file->move($location,$fileName);
            $enquiryRegister->enquiry_document = $fileName;
        }
        $plan = APQPPlanActivity::where('apqp_timing_plan_id',$enquiryRegister->apqp_timing_plan_id)->where('stage_id',1)->where('sub_stage_id',1)->first();
        if($status_id==3)
        {
            $enquiryRegister->status = $status_id;
            $enquiryRegister->verified_by = auth()->user()->id;
            $enquiryRegister->verified_at = Carbon::now();
        }
        if($status_id==5)
        {
            $enquiryRegister->status = $status_id;
        }

        $enquiryRegister->remarks = $request->input('remarks')??NULL;

        $enquiryRegister->save();
        $approval_user = $plan->approved_by->email;

        $plan->verified_date = Carbon::now();
        $plan->status_id = 3;
        $plan->gyr_status = "Y";
        $plan->update();

        // Mail
        $user_email = auth()->user()->email;
        $user_name = auth()->user()->name;

        //$ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
        $ccEmails = ["bharathmukesh85@gmail.com"];
        $activity = APQPPlanActivity::find($plan->id);
        Mail::to('edp@venakteswarasteels.com')
        ->cc($ccEmails)
        ->send(new ActivityMail($user_email,$user_name,$activity));
        //->send(new EnquiryRegisterMail($user_email,$user_name,$file_path,$enquiry));

        return redirect(route('activity.index'))->withSuccess('Enquiry Register Updated Successfully!');

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
                'enquiry_document' => 'required|mimes:csv,txt,xlsx,xls,pdf,jpg,png,PNG|max:2048',
                'type_of_enquiry' => 'required'
            ]);
            $enquiry_register = new EnquiryRegister;
            $enquiry_register->apqp_timing_plan_id = $request->apqp_timing_plan_id;
            $enquiry_register->stage_id = 1;
            $enquiry_register->sub_stage_id = 1;
            $enquiry_register->received_date = $request->received_date;
            $enquiry_register->enquiry_type = $request->type_of_enquiry;
            $enquiry_register->prepared_by = auth()->user()->id;
            $enquiry_register->ern_sample = $request->ern_sample;
            $enquiry_register->sir_sample = $request->sir_sample;
            $enquiry_register->safe_launch_sample = $request->safe_launch_sample;

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
            // Mail
            $user_email = auth()->user()->email;
            $user_name = auth()->user()->name;
            $file_path = $location.'/'.$fileName;
            $enquiry = EnquiryRegister::find($enquiry_register->id);
            //$ccEmails = ["msv@venkateswarasteels.com", "ld@venkateswarasteels.com","marimuthu@venkateswarasteels.com"];
            $ccEmails = ["bharathmukesh85@gmail.com"];
            Mail::to('edp@venkateswarasteels.com')
            ->cc($ccEmails)
            ->send(new EnquiryRegisterMail($user_email,$user_name,$file_path,$enquiry));
            $plan->actual_start_date = Carbon::now();
            $plan->prepared_date = Carbon::now();
            $plan->status_id = 2;
            $plan->gyr_status = "Y";
            $plan->update();

            return redirect(route('activity.index'))->withSuccess('Enquiry Register Updated Successfully!');
    }
    public function verify(Request $request)
    {
        $plan_id = $request->input('id');
        $enquiry_register = EnquiryRegister::where("apqp_timing_plan_id",$plan_id)->get();
        return view('apqp.enquiry_register');

    }
}
