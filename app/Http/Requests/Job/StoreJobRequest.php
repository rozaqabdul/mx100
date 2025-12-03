<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if (! $user || ! $user->hasRole('employer') || ! $user->company_id) {
            return false;
        }

        $job = $this->route('job');
        if ($job && $job->company_id !== $user->company_id) {
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
            'title'       => ['required','string','max:255'],
            'description' => ['required','string'],
            'status'      => ['required','in:draft,published'],
            'location'    => ['nullable','string'],
            'budget_min'  => ['nullable','integer'],
            'budget_max'  => ['nullable','integer','gte:budget_min'],
        ];
    }
}
