<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class UserPermissionTableSeeder extends Seeder
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

        Permission::insert([
            ['guard_name' => 'web', 'name' => 'add user', 'created_at' => now()],
            ['guard_name' => 'web', 'name' => 'edit user', 'created_at' => now()],
            ['guard_name' => 'web', 'name' => 'delete user', 'created_at' => now()],
            ['guard_name' => 'web', 'name' => 'view user', 'created_at' => now()],
        ]);
    }
}
