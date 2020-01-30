<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class WorkflowPermissionTableSeeder extends Seeder
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
            ['guard_name' => 'web', 'name' => 'add workflow', 'created_at' => now()],
            ['guard_name' => 'web', 'name' => 'edit workflow', 'created_at' => now()],
            ['guard_name' => 'web', 'name' => 'delete workflow', 'created_at' => now()],
            ['guard_name' => 'web', 'name' => 'view workflow', 'created_at' => now()],
        ]);
    }
}
