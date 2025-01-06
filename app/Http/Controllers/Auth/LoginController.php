<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

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

    /**
     * Send the response after the user was authenticated.
     *
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if (! getLoggedInUser()->status) {
            auth()->logout();
            Flash::error('Your account has been deactivated.');

            return redirect('login');
        }

        if (getLoggedInUser()->email_verified_at == null) {
            $userEmail = getLoggedInUser()->email;
            auth()->logout();

            return redirect('login')->with([
                'verifyEmail' => true, 'message' => 'Please verify your email.', 'userEmail' => $userEmail,
            ]);
        }

        if (getLoggedInUser()->hasRole('super_admin')) {
            $this->redirectTo = 'admin/dashboard';
        } else {
            if ($request->get('route_name') == 'front.pricing') {
                $this->redirectTo = 'pricing/';
            } else {
                if ($request->get('route_name') == 'front.portfolio.index') {
                    $this->redirectTo = 'portfolio/';
                } else {
                    $this->redirectTo = 'users/'.getLoggedInUser()->id.DIRECTORY_SEPARATOR.'edit';
                }
            }
        }

        if (! isset($request->remember)) {
            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath())
                    ->with('successMessage', 'Login Successfull.')
                    ->withCookie(\Cookie::forget('email'))
                    ->withCookie(\Cookie::forget('password'))
                    ->withCookie(\Cookie::forget('remember'));
        }

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath())
                ->with('successMessage', 'Login Successfull.')
                ->withCookie(\Cookie::make('email', $request->email, 3600))
                ->withCookie(\Cookie::make('password', $request->password, 3600))
                ->withCookie(\Cookie::make('remember', 1, 3600));

        if (Auth::check()) {
            return redirect()->route('users.edit', Auth::id());
        }
    }
}
