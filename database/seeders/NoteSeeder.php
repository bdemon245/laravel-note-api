<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            $tag = Tag::create(['value' => $value]);
            User::find(1)->tags()->attach($tag);
        }
        foreach (range(1, 50) as $key) {
            DB::table('taggables')->insert([
                'tag_id' => random_int(1, 5),
                'taggable_type' => fake()->randomElement(['App\Models\Note', 'App\Models\User']),
                'taggable_id' => random_int(1, 50),
            ]);
        }
    }
}
