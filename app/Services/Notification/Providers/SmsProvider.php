<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Providers\Contracts\Provider;

class SmsProvider implements Provider
{
    public $user;
    public $massage;
    public function __construct(User $user, string $massage)
    {
        $this->user = $user;
        $this->massage = $massage;
    }
    public function send()
    {
        // dd($this->user, $this->massage);
    }
}
