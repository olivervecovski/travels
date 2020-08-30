<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
      $user = User::find($request->id);

      if(!$user) {
        return response()->json([
          "message" => 'Could not find user',
          'id' => $request
        ], 404);
      }

      // if (! hash_equals((string) $request->id, (string) $user->getKey())) {
      //   throw new AuthorizationException;
      // }

      if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
        return response()->json([
          "message" => 'Unauthorized'
        ], 403);
      }

      if ($user->hasVerifiedEmail()) {
        return response()->json([
          "message" => 'User already verified'
        ], 403);
      }

      if ($user->markEmailAsVerified()) {
          event(new Verified($user));
      }

      return response()->json([
        'message' => 'Your email is now verified'
      ], 200);
    }

    public function resendVerificationEmail(Request $request) {
      $user = User::where('email', $request->email)->first();

      if(!$user) {
        return response()->json([
          'message' => 'Failed to send'
        ], 403);
      }

      $user->sendEmailVerificationNotification();

      return response()->json([
        'message' => 'Verification email sent!'
      ], 200);
    }


}
