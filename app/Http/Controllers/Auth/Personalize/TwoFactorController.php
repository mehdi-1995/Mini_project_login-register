<?php

namespace App\Http\Controllers\Auth\Personalize;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TwoFactorAuthentication;
use App\Http\Requests\Auth\ValidateCodeRequest;

class TwoFactorController extends Controller
{
    public function __construct(protected TwoFactorAuthentication $twoFactor, public Request $request)
    {
    }
    public function showTwoFactorForm()
    {
        return view('auth.two-factor.toggle');
    }
    public function requestActivate()
    {
        $response = $this->twoFactor->generateCode(auth()->user());
        return $response == $this->twoFactor::CODE_SEND
            ? redirect()->route('auth.two-factor.showEnterCode')
            : redirect()->back()->with('cantSendCode', __('auth.cantSendCode'));
    }
    public function showEnterCodeForm()
    {
        return view('auth.two-factor.enter-code');
    }
    public function confirmCode(ValidateCodeRequest $request)
    {
        $response = $this->twoFactor->activate();
        return $response == $this->twoFactor::ACTIVATE
            ? redirect()->route('index')->with('twoFactorActivated', __('auth.twoFactorActivated'))
            : redirect()->back()->with('invalidCode', __('auth.invalidCode'));
    }
    // public function validateCode()
    // {
    //     $this->request->validate([
    //         'code' => ['required', 'numeric', 'digits:4'], [
    //             'code.digits' => __('auth.invalidCode')
    //         ]
    //     ]);
    // }
    public function deActive()
    {
        $this->twoFactor->deActiveTwoFactor(auth()->user());
        return redirect()->route('index')->with('twoFactorDeactivated', __('auth.twoFactorDeactivated'));
    }
}




