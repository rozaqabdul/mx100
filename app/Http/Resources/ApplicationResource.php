<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'cv_url'    => asset('storage/'.$this->cv_path),
            'cover_letter' => $this->cover_letter,
            'freelancer' => [
                'id'   => $this->freelancer->id,
                'name' => $this->freelancer->name,
                'email'=> $this->freelancer->email,
            ],
            'applied_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
