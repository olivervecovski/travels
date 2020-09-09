<?php

namespace App;

use App\Models\Social_Account;
use App\Models\Trip;
use App\Models\User_profile;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyNotification;
use App\Traits\HasAvatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasAvatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function trips() {
        return $this->hasMany(Trip::class);
    }

    public function social_accounts() {
        return $this->hasMany(Social_Account::class);
    }

    public function user_profile() {
        return $this->hasOne(User_profile::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyNotification());
    }

}
