<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('our_work_translations', function (Blueprint $table) {
            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_h1')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

            $table->tinyInteger('set_404')->default(0);
            $table->tinyInteger('set_noindex')->default(0);
            $table->tinyInteger('set_nofollow')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
