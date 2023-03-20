<?php

namespace App\Models\Auth;

use App\Jobs\SendSmsJob;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFactor extends Model
{
    use HasFactory;
    const EXPIRED_CODE = 60; // 60 second
    protected $fillable = ['code', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function generateCode(user $user)
    {
        $user->code()->delete();
        return static::create([
            'user_id' => $user->id,
            'code' => mt_rand(1000, 9999)
        ]);
    }
    public function getCodeForSendAttribute()
    {
        return __('auth.codeForSend', ['code' => $this->code]);
    }
    public function send()
    {
        SendSmsJob::dispatch($this->user, $this->code_for_send);
    }
    public function isExpired()
    {
        return $this->created_at->diffInSeconds(now()) > self::EXPIRED_CODE;
    }
    public function isEqual($code)
    {
        return $this->code == $code;
    }
}
