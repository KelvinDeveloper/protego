<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\WorkGroup;
use App\WorkGroupUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated()
    {
        $WorkGroup = WorkGroupUser::where('user_id', Auth::user()->id )->where('recording', 1)->first();
        Session::put('work_group', WorkGroup::find($WorkGroup->work_group_id) );

        return ['status', true];
    }
}
