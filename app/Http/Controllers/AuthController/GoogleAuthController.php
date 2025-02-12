<?php

namespace App\Http\Controllers\AuthController;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\UserRepository;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\Auth\UserResource;

class GoogleAuthController extends Controller
{
   

    public function handleGoogleLogin(Request $request)
    {
        try {
           

            $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->access_token);
            $user = User::where('email', $googleUser->getEmail())->first();
           
            if (!$user) {       
                return response()->json([
                    'needs_nickname' => true,
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }
    
            
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'user' =>  new UserResource($user),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }
    

}
