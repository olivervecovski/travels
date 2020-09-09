<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    protected $fillable = ['image', 'provider_image', 'description'];
}
