<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function destinations () {
        return $this->hasMany(Destination::class);
    }
}
