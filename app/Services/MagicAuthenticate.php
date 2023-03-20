<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auth\MagicToken;
use Illuminate\Support\Facades\Auth;

class MagicAuthenticate
{
    const EXPIRED_TOKEN = 'expired_token';
    const AUTHENTICATED = 'authenticated';
    public function __construct(public Request $request)
    {
    }
    public function requestLink()
    {
        $user = $this->getUser();
        $user->generateToken()->sendLink([
            'remember' => $this->request->remember
        ]);
    }
    public function getUser()
    {
        return User::where('email', $this->request->email)->firstOrFail();
    }
    public function magicLogin(MagicToken $magicToken)
    {
        if ($magicToken->isExpired()) {
            return self::EXPIRED_TOKEN;
        }
        Auth::login($magicToken->user, $this->request->query('remember'));

        $magicToken->delete();

        return self::AUTHENTICATED;
    }
}
