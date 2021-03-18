<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('our_work_translations', function (Blueprint $table) {
            $table->text('description')->nullable();

            $table->dropColumn('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('our_work_translations', function (Blueprint $table){
            $table->string('url')->nullable();

            $table->dropColumn('description');
        });
    }
}
