<?php

namespace App\Services;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function register(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $data['password'] = bcrypt($data['password']);

            $companyId = null;
            if ($data['role'] === 'employer') {
                $company = Company::firstOrCreate(
                    ['slug' => $data['company']['slug']],
                    [
                        'name'        => $data['company']['name'],
                        'industry'    => $data['company']['industry'],
                        'website'     => $data['company']['website'],
                        'description' => $data['company']['description'],
                    ]
                );
                $companyId = $company->id;
            }

            /** @var \App\Models\User $user */
            $user = User::create([
                'name'       => $data['name'],
                'email'      => $data['email'],
                'password'   => $data['password'],
                'company_id' => $companyId,
            ]);

            $user->syncRoles([$data['role']]);

            return $user;
        });
    }
    public function login(array $data): ?User
    {
        if (! Auth::attempt($data)) {
            return null;
        }

        return Auth::user();
    }
    
}
