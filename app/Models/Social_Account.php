<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social_Account extends Model
{
    protected $table = 'social_accounts';
    
    protected $fillable = ['user_id', 'provider', 'provider_user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
