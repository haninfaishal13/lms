<?php

namespace Database\Seeders;

use App\Models\GradeCluster;
use Illuminate\Database\Seeder;

class GradeClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grade_cluster = [
            [
                'grade_id' => '1',
                'name' => 'A',
                'status' => '1',
            ],
            [
                'grade_id' => '1',
                'name' => 'B',
                'status' => '1',
            ],
            [
                'grade_id' => '2',
                'name' => 'A',
                'status' => '1',
            ],
            [
                'grade_id' => '2',
                'name' => 'B',
                'status' => '1',
            ],
            [
                'grade_id' => '3',
                'name' => 'A',
                'status' => '1',
            ],
            [
                'grade_id' => '3',
                'name' => 'B',
                'status' => '1',
            ],
        ];
        foreach($grade_cluster as $key => $value) {
            GradeCluster::create($value);
        }
    }
}
