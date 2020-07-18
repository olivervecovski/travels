<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function activitable() {
        return $this->morphTo();
    }
}
