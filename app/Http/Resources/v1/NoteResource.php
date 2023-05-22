<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
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
        try {
            $decryptedData = Crypt::decryptString($this->content);
        } catch (DecryptException $e) {
            $decryptedData = $e;
        }
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'title' => $this->title,
            'content' => $decryptedData,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
