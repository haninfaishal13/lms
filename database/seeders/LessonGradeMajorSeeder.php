<?php

namespace Database\Seeders;

use App\Models\LessonGradeMajor;
use Illuminate\Database\Seeder;

class LessonGradeMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lesson_grade_major = [
            [
                'lesson_id' => '1',
                'grade_id' => '1',
                'major_id' => '1',
                'name' => 'Matematika IPA kelas 10'
            ],
            [
                'lesson_id' => '1',
                'grade_id' => '2',
                'major_id' => '1',
                'name' => 'Matematika IPA kelas 11'
            ],
            [
                'lesson_id' => '1',
                'grade_id' => '3',
                'major_id' => '1',
                'name' => 'Matematika IPA kelas 12'
            ],
        ];

        foreach($lesson_grade_major as $key => $value) {
            LessonGradeMajor::create($value);
        }
    }
}
