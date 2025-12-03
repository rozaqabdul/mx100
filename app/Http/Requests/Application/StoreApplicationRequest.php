<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if (! $user || ! $user->hasRole('freelancer')) {
            return false;
        }

        $job = $this->route('job');
        if ($job && $job->status !== 'published') {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cv' => ['required','file','mimes:pdf,doc,docx','max:2048'],
            'cover_letter' => ['nullable','string'],
        ];
    }
}
