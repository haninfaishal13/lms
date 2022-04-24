<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lesson = [
            ['name' => 'Matematika'],
            ['name' => 'Biologi'],
            ['name' => 'Fisika'],
            ['name' => 'Kimia'],
            ['name' => 'Ekonomi',],
            ['name' => 'Sejarah',],
            ['name' => 'Sosiologi',],
            ['name' => 'Geografi',],
        ];

        foreach($lesson as $key => $value) {
            Lesson::create($value);
        }
    }
}
