<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SettingDatabaseSeeder extends Seeder
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

        $this->call(UserPermissionTableSeeder::class);
        $this->call(UserTypePermissionTableSeeder::class);
        $this->call(CalendarPermissionTableSeeder::class);
        $this->call(WorkflowPermissionTableSeeder::class);
    }
}
