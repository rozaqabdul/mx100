<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:6'],
            'role' => ['required','in:employer,freelancer'],
            'company.name' => ['required_if:role,employer', 'string'],
            'company.slug' => ['required_if:role,employer', 'string'],
            'company.industry' => ['required_if:role,employer', 'string'],
            'company.website' => ['required_if:role,employer', 'url'],
            'company.description' => ['required_if:role,employer', 'string'],
        ];
    }
}
