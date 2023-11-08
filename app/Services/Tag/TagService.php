<?php

declare(strict_types=1);

namespace App\Services\Tag;

use App\Models\Tag;
use App\DTOs\Tag\TagDto;

class TagService {

    public function store(TagDto $dto): Tag {
        return Tag::create([
            "user_id" => $dto->userId,
            "value"   => $dto->value
        ]);
    }
    public function update(TagDto $dto, Tag $tag): Tag {
        return tap($tag)->update([
            "user_id" => $dto->userId,
            "value"   => $dto->value
        ]);
    }
    public function delete(Tag $tag): bool {
        return $tag->delete();
    }
}
