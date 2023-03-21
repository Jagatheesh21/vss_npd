<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\PasswordUpdateMail;
use Mail;

class ChangePasswordController extends Controller
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
        return view('auth.change_password');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $to = 'edp@venkateswarasteels.com';
        $mail_data = ['name'=>auth()->user()->name,'email'=>auth()->user()->email,'password'=>$request->new_password];

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Mail::to('edp@venkateswarasteels.com')->send(new PasswordUpdateMail($mail_data));
        return back()->withSuccess('Password Updated Successfully!');
    }
}
