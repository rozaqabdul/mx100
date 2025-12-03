<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }
    public function login(array $data): ?User
    {
        if (! Auth::attempt($data)) {
            return null;
        }

        return Auth::user();
    }
    
}
