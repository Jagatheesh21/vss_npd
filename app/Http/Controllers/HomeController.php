<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
use App\Models\Customer;
use App\Models\SubStage;
use Illuminate\Support\Facades\DB;
use App\Mail\NotifyMail;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_lists = User::where('id','>',1)->get();
        $sub_stages_count = SubStage::get()->count();
        $total_users = User::where('id','>',1)->count();
        $total_customers = Customer::get()->count();
        $timing_plan_lists = APQPTimingPlan::GroupBy('status_id')->get();
        DB::table('apqp_timing_plans')
        ->join('apqp_timing_plan_activities')->
        dd($timing_plan_lists);
        $pending_activities = APQPPlanActivity::pending();
        $completed_activities = APQPPlanActivity::completed();
        $activity_list = APQPPLanActivity::with('plan','plan.part_number','plan.customer','stage','sub_stage','plan.status','user')->upcoming()->get();
        $total_activities = $pending_activities+$completed_activities;
        $percentage = $completed_activities==0?0:round(($completed_activities/$total_activities)*100);
        return view('home',compact('user_lists','timing_plan_lists','sub_stages_count','total_customers','total_users','total_activities','pending_activities','completed_activities','percentage','activity_list'));
    }
    public function test_mail()
    {
        $user_detail = User::select('name')->find(1);
        $user = $user_detail->name;
      return view('email.test',compact('user'));
        //

        // try {
        //     Mail::to('edp@venkateswarasteels.com')->send(new NotifyMail($user));
        //     //return response()->with('success','Mail Send Successfully!');
        //     return "Success";
        // } catch (\Throwable $th) {
        //    //return response()->with('error',$th->getMessage());
        //    return $th->getMessage();
        // }
    }
}
