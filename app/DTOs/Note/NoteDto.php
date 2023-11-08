<?php

namespace App\DTOs\Note;

use App\Http\Requests\Note\Api\NoteApiRequest;

class NoteDto {
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly ?string $userId,
    ) {
    }

    public static function transformApiRequest(NoteApiRequest $request): self {
        return new self(
            title: $request->input("title"),
            content: $request->input("content"),
            userId: $request->user()?->id,
        );
    }

}
