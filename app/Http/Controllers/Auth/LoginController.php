<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Config;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Auth;
use Closure;
use Session;


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
    //kiem tra quyen o day :))
    //tra ve index neu la nguoi dung ko co role
    //tra ve admin neu la quan tri vien
    protected $redirectTo = '/admin';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct()
    {
        // $this->redirectTo = url()->previous();
        $this->middleware('guest')->except('logout');
    }

    //return back url su dung showloginform va authenticated
    public function showLoginForm()
    {
        session(['link' => url()->previous()]);

        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect(session('link'));
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     // if ( $user->roles()->count() > Config::get('social.zero') ) {// do your margic here
    //     //     return redirect()->route('admin.index');
    //     // }

    //      // return redirect('/');
    //      return back();
    // }


    // public function showLoginForm()
    // {
    //     if(!session()->has('url.intended'))
    //     {
    //         session(['url.intended' => url()->previous()]);
    //     }
    //     return view('auth.login');    
    // }

    protected $redirectAfterLogout = '/';

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect($this->redirectAfterLogout);
    }

    // protected function validateLogin(UserLoginRequest $request)
    // {
        
    // }
    // 
    protected function sendFailedLoginResponse(Request $request)
    {
        // throw ValidationException::withMessages([
        //     $this->username() => ['Tài khoản hoặc mật khẩu không tồn tại'],
        //     // $this->password() => ['Tài khoản hoặc mật khẩu không tồn tại'],
        // ]);
        // 
        if ( ! User::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => ['Tài khoản không tồn tại'],
                ]);
        }

        if ( ! User::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => ['Mật khảu không chính xác'],
                ]);
        }

    }


}
