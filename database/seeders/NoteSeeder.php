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
        $user = User::find(1);
        foreach ($tags as $key => $value) {
            $tag = Tag::create([
                'user_id' => $user->id,
                'value' => $value
            ]);
        }
        foreach (range(1, 50) as $key) {
            DB::table('taggables')->insert([
                'tag_id' => random_int(1, 5),
                'taggable_type' => fake()->randomElement(['App\Models\Note']),
                'taggable_id' => random_int(1, 50),
            ]);
        }
    }
}
