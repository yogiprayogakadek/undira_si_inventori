<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    // protected function credentials(\Illuminate\Http\Request $request)
    // {
    //     //return $request->only($this->username(), 'password');
    //     return [
    //         'username' => $request->{$this->username()},
    //         'password' => $request->password,
    //         'status' => 1
    //     ];
    // }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'exists:pengguna,' . $this->username() . ',status,1',
            'password' => 'required',
        ], [
            $this->username() . '.exists' => 'Username yang anda gunakan tidak ada atau status tidak aktif.'
        ]);
    }
}
