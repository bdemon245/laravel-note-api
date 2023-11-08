<?php

namespace App\DTOs\Note;

use App\Http\Requests\Api\Note\NoteApiRequest;


class NoteDto {
    public function __construct(
        public readonly string $content,
        public readonly ?string $userId,
        public readonly ?string $title = null,
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
