<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ValidateCodeRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\TwoFactorAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class AuthenticatedSessionController extends Controller
{
    public function __construct(protected TwoFactorAuthentication $twoFactor)
    {
    }
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        // $user = User::findOrFail($request->email);  findOrFail not response
        $user = $this->getUser($request);

        if ($user->has_two_factor) {
            $this->twoFactor->generateCode($user);
            return $this->sendHasTwoFactorResponse();
        }
    }
    public function getUser($request)
    {
        return User::where('email', $request->email)->firstOrFail();
    }
    public function sendHasTwoFactorResponse()
    {
        return redirect()->route('auth.login.showCodeForm');
    }
    public function showCodeForm()
    {
        return view('auth.two-factor.login-code');
    }
    public function confirmCode(ValidateCodeRequest $validateCode)
    {
        $response = $this->twoFactor->login();
        $response == $this->twoFactor::AUTHENTICATED
            ? $this->sendResponseSuccess() : redirect()->back()->with('invalid_code', __());
    }
    public function sendResponseSuccess()
    {
        session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
