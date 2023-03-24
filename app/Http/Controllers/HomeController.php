<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\APQPTimingPlan;
use App\Models\APQPPlanActivity;
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
        $timing_plan_lists = APQPTimingPlan::get();
        $pending_activities = APQPPlanActivity::pending();
        $completed_activities = APQPPlanActivity::completed();
        $total_activities = $pending_activities+$completed_activities;
        $percentage = $completed_activities==0?0:round(($completed_activities/$total_activities)*100);
        return view('home',compact('user_lists','timing_plan_lists','total_activities','completed_activities','percentage'));
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
