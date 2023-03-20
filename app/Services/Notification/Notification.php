<?php

namespace App\Services\Notification;

use App\Services\Notification\Providers\Contracts\Provider;
use Exception;

class Notification
{
    public function __call($name, $arguments)
    {
        $providerPath = __NAMESPACE__ . '\Providers\\' . substr($name, 4) . 'Provider';
        if (!class_exists($providerPath)) {
            throw new Exception('class dose not exist');
        }
        $provider = new $providerPath(...$arguments);
        if (!is_subclass_of($provider, Provider::class)) {
        }
        $provider->send();
    }
}
