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
        $user_lists = User::get();
        // $user ="jagatheesh21@gmail.com";
        // $data = array('name'=>"Test Mail");
        // Mail::send(['text'=>'mail'], $data, function($message) {
        //     $message->to('jagatheesh21@gmail.com', 'NPD')->subject
        //        ('Laravel Basic Testing Mail');
        //     $message->from('edp@venkateswarasteels.com','EDP');
        //  });
        //Mail::to($user)->send();

        return view('home',compact('user_lists'));
    }
    public function test_mail()
    {
        $user = User::find(1);
        
        try {
            Mail::to('jagatheesh21@gmail.com')->send(new NotifyMail($user));
            return response()->withSuccess('Mail Send Successfully!');
        } catch (\Throwable $th) {
           return reponse()->withError($th->getMessage());
        }
    }
}
