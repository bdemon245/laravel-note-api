<?php

namespace App\DTOs\Note;

use Illuminate\Http\Request;
use App\DTOs\Base\DtoApiInterface;
use App\Http\Requests\Note\Api\NoteStoreApiRequest;
use App\Http\Requests\Note\Api\NoteUpdateApiRequest;

class NoteDto {
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly ?string $userId,
    ) {
    }

    public static function transformStoreApiRequest(NoteStoreApiRequest $request): self {
        return new self(
            title: $request->input("title"),
            content: $request->input("content"),
            userId: $request->user()?->id,
        );
    }
    public static function transformUpdateApiRequest(NoteUpdateApiRequest $request): self {
        return new self(
            title: $request->input("title"),
            content: $request->input("content"),
            userId: $request->user()?->id,
        );
    }

}
