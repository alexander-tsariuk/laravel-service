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

        DB::table('settings')->insert([
            'code' => 'mainpage.about_company_ru',
            'label' => 'Основные направления компании (Русская версия)',
            'fieldType' => 3,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage.about_company_ua',
            'label' => 'Основные направления компании (Украинская версия)',
            'fieldType' => 3,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage.about_us_ru',
            'label' => 'О нас (Русская версия)',
            'fieldType' => 3,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage.about_us_ua',
            'label' => 'О нас (Украинская версия)',
            'fieldType' => 3,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage_seo.title_ru',
            'label' => 'Заголовок страницы (Русская версия)',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage_seo.title_ua',
            'label' => 'Заголовок страницы (Украинская версия)',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);
        DB::table('settings')->insert([
            'code' => 'mainpage_seo.h1_ru',
            'label' => 'H1 (Русская версия)',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage_seo.h1_ua',
            'label' => 'H1 (Украинская версия)',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage_seo.keywords_ru',
            'label' => 'Ключевые слова (Русская версия)',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage_seo.keywords_ua',
            'label' => 'Ключевые слова (Украинская версия)',
            'fieldType' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage_seo.description_ru',
            'label' => 'Описание (Русская версия)',
            'fieldType' => 2,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage_seo.description_ua',
            'label' => 'Описание (Украинская версия)',
            'fieldType' => 2,
            'status' => 1,
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'code' => 'mainpage.map_code',
            'label' => 'Код карты',
            'fieldType' => 2,
            'status' => 1,
            'created_at' => now(),
        ]);
    }
}
