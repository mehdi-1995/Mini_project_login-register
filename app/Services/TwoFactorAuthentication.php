<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auth\TwoFactor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class TwoFactorAuthentication
{
    const CODE_SEND = 'code_send';
    const INVALID_CODE = 'invalid_code';
    const ACTIVATE = 'activate';
    const AUTHENTICATED = 'authenticated';
    protected $code;
    public function __construct(public Request $request)
    {
    }
    public function generateCode(User $user)
    {
        $code = TwoFactor::generateCode($user);
        $code->send();
        $this->setSession($code);
        // dd(session()->all());
        return static::CODE_SEND;
    }
    public function setSession($code)
    {
        session([
            'user_id' => $code->user_id,
            'code_id' => $code->id,
            'remember' => $this->request->remember,
        ]);
    }
    public function activate()
    {
        if (!$this->isValidate()) return self::INVALID_CODE;
        $this->getToken()->delete();
        $this->getUser()->activeTwoFactor();
        // dd(session()->all());
        $this->forgetSession();
        // dd(session()->all());
        return self::ACTIVATE;
    }
    public function login()
    {
        if (!$this->isValidate()) return self::INVALID_CODE;
        $this->getToken()->delete();
        Auth::login($this->getUser(), session('remember'));
        $this->forgetSession();
        return self::AUTHENTICATED;
    }
    public function isValidate()
    {
        return !$this->getToken()->isExpired() && $this->getToken()->isEqual($this->request->code);
    }
    public function getToken()
    {
        return $this->code ?? $this->code = TwoFactor::findOrFail(session('code_id'));
    }
    public function getUser()
    {
        return User::findOrFail(session('user_id'));
    }
    public function forgetSession()
    {
        session(['user_id', 'code_id', 'remember']);
    }
    public function deActiveTwoFactor(User $user)
    {
        return $user->deActiveTwoFactor();
    }
}
