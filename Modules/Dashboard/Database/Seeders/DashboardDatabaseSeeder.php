<?php

namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DashboardDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        DB::table('settings')->insert([
            'code' => 'general.sitename',
            'label' => 'Название сайта',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'general.url',
            'label' => 'Ссылка на сайт',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);
    }
}
