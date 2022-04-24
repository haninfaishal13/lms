<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grade = [
            [
                'name' => '10',
                'status' => '1',
            ],
            [
                'name' => '11',
                'status' => '1',
            ],
            [
                'name' => '12',
                'status' => '1',
            ],
        ];
        foreach($grade as $key => $value) {
            Grade::create($value);
        }
    }
}
