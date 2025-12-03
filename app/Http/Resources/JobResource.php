<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'status'      => $this->status,
            'location'    => $this->location,
            'budget_min'  => $this->budget_min,
            'budget_max'  => $this->budget_max,
            'company'     => [
                'id'   => $this->company->id,
                'name' => $this->company->name,
            ],
            'posted_by'   => [
                'id'   => $this->employer->id,
                'name' => $this->employer->name,
            ],
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
    }
}
