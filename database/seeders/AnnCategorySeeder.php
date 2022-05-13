<?php

namespace Database\Seeders;

use App\Models\AnnCategory;
use Illuminate\Database\Seeder;

class AnnCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $announcement_category = [
            [
                'name' => 'Administrator',
                'status' => '1'
            ],
            [
                'name' => 'Pelajaran',
                'status' => '1'
            ],
            [
                'name' => 'Ujian',
                'status' => '1'
            ],
        ];
        foreach($announcement_category as $key => $value) {
            AnnCategory::create($value);
        }
    }
}
