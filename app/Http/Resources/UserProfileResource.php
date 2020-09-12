<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'description' => $this->user_profile->description,
            'trips' => $this->trips
        ];
    }
}
