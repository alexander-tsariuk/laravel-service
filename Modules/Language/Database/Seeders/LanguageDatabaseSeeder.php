<?php

namespace Modules\Language\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LanguageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();

        // $this->call("OthersTableSeeder");

        DB::table('languages')->insert([
            'name' => 'Русский',
            'prefix' => 'ru',
            'status' => 1,
            'default' => 1,
        ]);

        DB::table('languages')->insert([
            'name' => 'Украинский',
            'prefix' => 'ua',
            'status' => 1,
            'default' => 0,
        ]);
    }
}
