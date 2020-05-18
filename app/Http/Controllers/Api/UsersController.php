<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            User::paginate()
        );
    }
}
