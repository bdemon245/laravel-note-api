<?php
namespace App\DTOs\Tag;

use App\Http\Requests\Api\Tag\TagApiRequest;

class TagDto {
    public function __construct(
        public readonly int $userId,
        public readonly string $value,
    ) {
    }

    public static function transformApiRequest(TagApiRequest $request): self {
        return new self(
            userId: $request->user()?->id,
            value: $request->value
        );
    }
}
