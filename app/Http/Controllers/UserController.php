<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Http\Resources\UserProfileResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required|confirmed'
        ]);

        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        return response()->json([
            'user' => new UserProfileResource($user)
        ]);
    }

    public function update_image(Request $request) {
        
    }
}
