<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Encryption\DecryptException;

class NoteResource extends JsonResource
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
            'userId' => $this->user_id,
            'title' => $this->title,
            'content' => $this->content,
            'tags' => TagResource::collection($this->tags),
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
            "createdSince" => $this->created_at->diffForHumans(),
            "updatedSince" => $this->updated_at->diffForHumans(),
        ];
    }
}
