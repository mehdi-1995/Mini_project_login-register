<?php

namespace App\Http\Controllers\Auth\Personalize;

use Illuminate\Http\Request;
use App\Models\Auth\MagicToken;
use App\Services\MagicAuthenticate;
use App\Http\Controllers\Controller;

class MagicController extends Controller
{
    public function __construct(public Request $request, protected MagicAuthenticate $magicAuthenticate)
    {
    }
    public function showMagicForm()
    {
        return view('auth.magic-login');
    }
    public function sendToken()
    {
        $this->validateRequest();
        $this->magicAuthenticate->requestLink();
        return redirect()->back()->with('magicLinkSent', __('auth.magicLinkSent'));
    }
    public function validateRequest()
    {
        $this->request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);
    }
    public function authenticate(MagicToken $magicToken)
    {
        return $this->magicAuthenticate->magicLogin($magicToken) == $this->magicAuthenticate::AUTHENTICATED
            ? redirect()->route('index')
            : redirect()->route('login.magic.showMagicForm')->with('invalidToken', __('auth.invalidToken'));
    }
}
