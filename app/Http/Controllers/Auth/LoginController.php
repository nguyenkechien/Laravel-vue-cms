<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
   * The user has been authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
  protected function authenticated(Request $request, $user)
  {
    //
    return redirect('admin');
  }
  /**
   * Where to redirect users after login.
   *
   * @var string
   */

  /**
   * The user has logged out of the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return mixed
   */
  protected function loggedOut(Request $request)
  {
    $token = JWTAuth::getToken();
    try {
      JWTAuth::invalidate($token);
    } catch (JWTException $e) {
      JWTAuth::unsetToken();
    }
    return redirect()->route('login');
  }

  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }
}
