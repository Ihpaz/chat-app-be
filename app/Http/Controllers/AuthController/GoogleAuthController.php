<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    protected $repo;
    public function __construct()
    {
        $this->repo = new UserRepository();
    }


    public function redirectToGoogle()
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    // Handle Google callback
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email',$googleUser->getEmail())->fisrt();

            $payload['name']= $googleUser->getName();
            $payload['email']= $googleUser->getEmail();
            $payload['avatar']= $googleUser->getEmail();

            if(!$user){
                $user = $this->repo->saveData($payload);
            }
          
            // Generate Sanctum token
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Authentication failed'], 401);
        }
    }
}
