<?php

namespace App\Models\Auth;

use App\Mail\MagicLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class MagicToken extends Model
{
    use HasFactory;
    const EXPIRED_TOKEN = 120;
    protected $fillable = ['user_id', 'token'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sendLink(array $option)
    {
        Mail::to($this->user->email)->send(new MagicLink($this, $option));
    }
    public function isExpired()
    {
        return $this->created_at->diffInSeconds(now()) > self::EXPIRED_TOKEN;
    }
    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', now()->subSecond(self::EXPIRED_TOKEN));
    }
}
