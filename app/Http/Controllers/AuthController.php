<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckTokenRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Social_Account;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect'
            ], 403);
        }
        
        if(!$user->email_verified_at){
            return response()->json([
                'message' => 'You need to verify your email before you can sign in'
            ], 403);
        }
        
        return $this->respondWithToken($user->createToken('Auth Token')->accessToken, $user);
    }

    public function signup(SignupRequest $request) {
        if (User::where('email', '=', $request->email)->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Email already exists',
                'errors' => [
                    'email' => ['Email already exists']
                ]
            ], 403);
         }
         $user = User::create($request->all());

        $user->sendEmailVerificationNotification;

        return response()->json([
            'message' => 'Verification email sent'
        ], 200);
    }

    public function me() {
        return response()->json(auth()->user());
    }

    public function logout() {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    public function redirectToProvider($provider) {
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return response()->json([
            'url' => $url
        ]);
    }

    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->stateless()->user();


        if(!$user->token) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to login'
            ], 401);
        }

        $appUser = User::whereEmail($user->email)->first();

        if(!$appUser) {
            // create user and add the provider
            $appUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Str::random(10)
            ]);

            $this->createSocialAccount($appUser, $user->id, $provider);

        } else {
            // user already exists
            $this->createSocialAccount($appUser, $user->id, $provider);
        }

        // login user
        $access_token = $appUser->createToken('Auth Token')->accessToken;

        return $this->respondWithToken($access_token, $appUser);
    }

    public function checkToken(CheckTokenRequest $request) 
    {
        $pw_reset = DB::table('password_resets')->where('email', '=', $request->email)->first();
        dd($pw_reset);
        $msg = '';
        $status = 200;
        $email = '';

        if(!$pw_reset) {
            $msg = 'Password reset token does not exist';
            $status = 404;
        } else {
            dd($pw_reset);
            if($pw_reset->created_at->diffInHours(Carbon::now(), false) > 1) {
                $msg = 'Password reset token have expired';
                $status = 403;
            } else {
                $email = $pw_reset->email;
            }
        }

        return response()->json([
            'message' => $msg,
        ], $status);
    }

    private function createSocialAccount($user, $provider_id, $provider) {
        $social_account = $user->social_accounts()->where('provider', $provider)->first();

            
        if(!$social_account) {
            // create provider
            $social_account = Social_Account::create([
                'provider' => $provider,
                'provider_user_id' => $provider_id,
                'user_id' => $user->id
            ]);
        }
    }

    protected function respondWithToken($token, $user) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user
        ], 200);
    }
}
