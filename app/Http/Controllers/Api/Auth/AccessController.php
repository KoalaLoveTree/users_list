<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AccessRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccessController extends Controller
{
    public function store(AccessRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            throw new AuthorizationException();
        }
        $user = Auth::user();
        $token = Str::random(60);
        $user->update(['api_token' => hash('sha256', $token)]);
        return ['token' => $token];
    }
}
