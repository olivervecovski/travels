<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Trip extends Model
{
    protected static function boot() {
        parent::boot();
    
        static::creating(function($trip) {
          $trip->user_id = Auth::id();
        });
    }
    protected $guarded = [];

    protected $fillable = ['start_date', 'private', 'name', 'description', 'end_date', 'image_url'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function destinations () {
        return $this->hasMany(Destination::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
