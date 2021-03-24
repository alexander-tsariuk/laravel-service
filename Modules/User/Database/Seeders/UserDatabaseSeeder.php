<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->insert([
            'name' => "Александр",
            'surname' => "Царюк",
            'email' => "alexander.tsariuk@icloud.com",
            'phone' => "380956343602",
            'password' => Hash::make('test123456'),
            'status' => 1
        ]);
    }
}
