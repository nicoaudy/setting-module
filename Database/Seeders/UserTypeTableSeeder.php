<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Entities\UserType;
use Illuminate\Database\Eloquent\Model;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        app()['cache']->forget('spatie.permission.cache');

        UserType::insert([
            ['name' => 'admin', 'description' => 'admin', 'created_at' => now()],
            ['name' => 'staff', 'description' => 'staff', 'created_at' => now()],
            ['name' => 'teacher', 'description' => 'teacher', 'created_at' => now()],
            ['name' => 'student', 'description' => 'student', 'created_at' => now()],
        ]);
    }
}
