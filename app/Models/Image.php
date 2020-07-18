<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    protected $types = [
        'trip' => 'App\Models\Trip',
        'destination' => 'App\Models\Destination'
    ];

    public function imageable() {
        return $this->morphTo();
    }
}
