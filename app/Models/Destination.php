<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $guarded = [];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function images() {
        return $this->hasMany(Image::class, 'td_id')->where('images.type', '='. 'destination');
    }
}
