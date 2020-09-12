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
    public function update_general(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $user = Auth::user();
        
        $user->name = $request->name;
        $user->user_profile->description = $request->description;

        $user->save();
        $user->user_profile->save();

        return response()->json([
            'user' => new UserProfileResource($user)
        ], 200);
    }

    public function update_password(Request $request) {
        $request->validate([
            'password' => 'required|confirmed',
            'current_password' => 'required'
        ]);

        $user = Auth::user();
        if(!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Incorrect password'
            ], 403);
        }
        $user->password = $request->password;
        $user->save();

        return response()->json([
            'message' => 'Password changed'
        ], 200);
    }

    public function update_image(Request $request) {
        $request->validate([
            'image' => 'required|file|image|'
        ]);
        
        $path = $request->image->store('avatars', 's3');

        $user = Auth::user();
        $user->user_profile->image_filename = basename($path);
        $user->user_profile->image = Storage::disk('s3')->url($path);
        $user->user_profile->save();

        return response()->json([
            'user' => new UserProfileResource($user)
        ], 200);
    }
}
