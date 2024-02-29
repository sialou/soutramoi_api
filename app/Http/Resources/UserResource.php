<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified' => $this->email_verified,
            'phone' => $this->phone,
            'phone_verified' => $this->phone_verified,
            'gender' => $this->gender,
            'city' => $this->city,
            'town' => $this->town,
            'active' => $this->active,
            'photo_url' => $this->cover_url,
            'cover_url' => $this->cover_url,
            'professional' => new ProfessionnalResource($this->professional),
        ];
    }
}
