<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequeteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
       return[
        'id' => $this ->id,
        'created_at' => $this ->creat_at,
        'user_id' => $this ->user_id,
        'job_id' => $this ->job_id,
        'hour' => $this ->hour,
        'day' => $this ->day,
        'type' => $this ->type,
        'description' => $this ->description
       ];

    }
}
