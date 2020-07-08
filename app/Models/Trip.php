<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function destinations () {
        return $this->hasMany(Destination::class);
    }

    public function images() {
        return $this->hasMany(Image::class, 'td_id')->where('images.type', '=', 'trip');
    }
}
