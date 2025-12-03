<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            
            'roles'     => $this->roles->pluck('name'),

            'company'   => $this->company ? [
                'id'          => $this->company->id,
                'name'        => $this->company->name,
                'slug'        => $this->company->slug,
                'industry'    => $this->company->industry,
                'website'     => $this->company->website,
                'description' => $this->company->description,
            ] : null,

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
