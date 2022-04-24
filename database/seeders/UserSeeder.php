<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@lms.com',
                'password' => bcrypt('admin1234'),
                'role' => 'admin',
            ],
            [
                'username' => 'donawariska',
                'name' => 'Dona Wariska',
                'email' => 'donawariska@smaperjuangan.sch.id',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'username' => 'aurumnf',
                'name' => 'Aurum Nur Fadhillah',
                'email' => 'aurumnf@student.com',
                'password' => bcrypt('hidupmulia13'),
                'role' => 'student',
            ],
        ];

        foreach($user as $key => $value) {
            User::create($value); 
        }
    }
}
