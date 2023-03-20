<?php

namespace App\Models\Traits;

use App\Models\Auth\TwoFactor;

trait HasTwoFactor
{
    public function code()
    {
        return $this->hasOne(TwoFactor::class);
    }
    public function activeTwoFactor()
    {
        $this->has_two_factor = true;
        $this->save();
    }
    public function hasTwoFactor()
    {
        return $this->has_two_factor;
    }
    public function deActiveTwoFactor()
    {
        $this->has_two_factor = false;
        $this->save();
    }
}
