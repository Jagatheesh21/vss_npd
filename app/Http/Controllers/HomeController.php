<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        return view('home',compact('user_lists'));
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
