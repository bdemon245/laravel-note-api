<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Note::factory()->count(50)->create();

        $tags = [
            'React',
            'Vue',
            'Tailwind',
            'Bootstrap',
            'Laravel'
        ];
        foreach ($tags as $key => $value) {
            Tag::create(['value' => $value]);
        }
        foreach (range(1, 50) as $key) {
            DB::table('note_tag')->insert([
                'note_id' => random_int(1, 50),
                'tag_id' => random_int(1, 5),
            ]);
        }
    }
}
