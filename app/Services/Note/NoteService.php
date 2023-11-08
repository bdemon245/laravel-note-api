<?php
namespace App\Services\Note;

use App\DTOs\Note\NoteDto;
use App\Models\Note;

class NoteService {
    public function store(NoteDto $dto) {
        return Note::create([
            "user_id" => $dto->userId,
            "title"   => $dto->title,
            "content" => $dto->content,
        ]);
    }
    public function update(Note $note, NoteDto $dto) {
        return tap($note)->update([
            "title"   => $dto->title,
            "content" => $dto->content,
        ]);
    }
    public function delete(Note $note) {
        return $note->delete();
    }

}


