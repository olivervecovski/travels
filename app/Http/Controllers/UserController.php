<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Http\Resources\UserProfileResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'user_profile' => new UserProfileResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'confirmed|min:8|sometimes|nullable',
            'image' => 'sometimes|nullable|image|',
            'current_password' => 'required_if:password,=,null'
        ]);

        $user = Auth::user();

        if($request->password) {
            if(!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'message' => 'Incorrect password'
                ], 403);
            }

            $user->password = $request->password;
        }

        if($request->image) {
            $path = $request->image->store('avatars', 's3');
            $user->user_profile->image_filename = basename($path);
            $user->user_profile->image = Storage::disk('s3')->url($path);
        }

        if($request->description) {
            $user->user_profile->description = $request->description;
        }

        $user->name = $request->name;

        $user->save();
        $user->user_profile->save();

        return response()->json([
            'user' => new UserProfileResource($user)
        ], 200);
    }
}
