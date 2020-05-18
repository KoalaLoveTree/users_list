<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function show()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function store()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect(route('google.login'));
        }
        $existingUser = User::where('email', $user->email)->first();
        $token = Str::random(60);
        if ($existingUser) {
            $existingUser->update(['api_token' => hash('sha256', $token)]);
        } else {
            User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'google_id' => $user->getId(),
                'api_token' => hash('sha256', $token),
            ]);
        }
        return ['token' => $token];
    }
}
