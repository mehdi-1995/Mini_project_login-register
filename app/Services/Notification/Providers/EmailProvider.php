<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Providers\Contracts\Provider;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailProvider implements Provider
{
    public function __construct(protected User $user, protected Mailable $mailable)
    {
    }
    public function send()
    {
        Mail::to($this->user->email)->send($this->mailable);
    }
}
