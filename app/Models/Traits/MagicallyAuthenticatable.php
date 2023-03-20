<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use App\Models\Auth\MagicToken;
use App\Services\Notification\Notification;

trait MagicallyAuthenticatable
{
    public function magicToken()
    {
        return $this->hasOne(MagicToken::class);
    }
    public function generateToken()
    {
        return $this->magicToken()->create([
            'token' => Str::random(20),
        ]);
    }
}
