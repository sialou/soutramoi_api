<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionnalResource extends JsonResource
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
            'geolocation' => $this->geolocation,
            'services' => $this->services,
            'products' => $this->products,
            'address' => $this->address,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'likes_count' => $this->likes_count,
            'job' => $this->job,
        ];
    }
}
