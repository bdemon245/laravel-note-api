<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "userId" => $this->user_id,
            "value" => $this->value,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
            "createdSince" => $this->created_at->diffForHumans(),
            "updatedSince" => $this->updated_at->diffForHumans(),
            "pivot" => $this->pivot,
        ];
    }
}
