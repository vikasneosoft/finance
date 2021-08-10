<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;


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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login user
     *
     * @param array
     * @return objectid
     */

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $auth = Auth::attempt(
            [
                'email'  => strtolower($request->get('email')),
                'password'  => $request->get('password')
            ],
        );

        if ($auth) {
            return redirect()->route('employee.dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }
    /**
     * logout user
     *
     */
    public function logout()
    {

        Auth::logout();
        return redirect('/');
    }
}
