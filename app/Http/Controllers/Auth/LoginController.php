<?php

namespace App\Http\Controllers\Auth;

use App\TeacherModel;
use App\StudentModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Pusher\Pusher;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function authenticated()
    {

        //$status=Auth::user()->status;
        $user = Auth::user();
        $user->status = 'on';
        $user->save();
        $role = Auth::user()->profession;
        $authemail = Auth::user()->email;

        $teacheremail = TeacherModel::all()->pluck('email');
        $Studentemail = StudentModel::all()->pluck('email');
        for ($i = 0; $i < count($teacheremail); $i++) {
            if ($authemail == $teacheremail[$i]) {
                return redirect()->route('TeacherUi');
            }
        }
        for ($i = 0; $i < count($Studentemail); $i++) {
            if ($authemail == $Studentemail[$i]) {
                return redirect()->route('studentUi');
            }
        }
        if ($role == 'Student') {
            session()->flash('success', 'Welcome, ' . Auth::user()->name . '! You are Logged Student Portal.');
            return redirect()->route('Student');
        } elseif ($role == 'Teacher') {
            session()->flash('success', 'Welcome, ' . Auth::user()->name . '! You are Logged into the Admin Portal.');
            return redirect()->route('Teacher');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
