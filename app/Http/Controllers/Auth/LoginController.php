<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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


    // protected function validateLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         $this->username() => 'exists:pengguna,' . $this->username() . ',status,1',
    //         'password' => 'required',
    //     ], [
    //         $this->username() . '.exists' => 'Username yang anda gunakan tidak ada atau status tidak aktif.',
    //         'password.required' => 'Password is required.',
    //     ]);
    // }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|exists:pengguna,' . $this->username() . ',status,1',
            'password' => 'required|string',
        ], [
            $this->username() . '.exists' => 'Username yang anda gunakan tidak ada atau status tidak aktif.',
            'password.required' => 'Password is required.',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\Pengguna::where($this->username(), $request->{$this->username()})->first();

        if ($user && !Auth::attempt([$this->username() => $request->{$this->username()}, 'password' => $request->password])) {
            throw ValidationException::withMessages([
                'password' => ['Password yang anda masukkan salah.'],
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
