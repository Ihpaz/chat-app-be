<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Request\Auth\ApiGoogleLoginRequest;


class GoogleAuthController extends Controller
{
    protected $repo;
    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function handleGoogleLogin(ApiGoogleLoginRequest $request)
    {
        try {
           
            $code = $request->input('code');
            $googleUser = Socialite::driver('google')->stateless()->userFromToken($code);
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
    
            return response()->json(['token' => $token, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Authentication failed'], 401);
        }
    }
    

    // Handle Google callback
    // public function handleGoogleCallback(Request $request)
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->stateless()->user();

    //         $user = User::where('email',$googleUser->getEmail())->fisrt();

    //         $payload['name']= $googleUser->getName();
    //         $payload['email']= $googleUser->getEmail();
    //         $payload['avatar']= $googleUser->getEmail();

    //         if(!$user){
    //             $user = $this->repo->saveData($payload);
    //         }
          
    //         // Generate Sanctum token
    //         $token = $user->createToken('API Token')->plainTextToken;

    //         return response()->json([
    //             'token' => $token,
    //             'user' => $user
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Authentication failed'], 401);
    //     }
    // }
}
