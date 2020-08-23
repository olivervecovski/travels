<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $guarded = [];

    protected $fillable = ['description', 'start_date', 'end_date', 'country'];

    protected $morphClass = 'App\Models\Destination';

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
