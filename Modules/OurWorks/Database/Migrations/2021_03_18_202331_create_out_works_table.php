<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_works', function (Blueprint $table) {
            $table->id();
            $table->string('prefix')->unique();
            $table->tinyInteger('status')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('our_work_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rowId')->unsigned();
            $table->string('name');
            $table->string('url')->nullable();
            $table->bigInteger('languageId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('our_works');
        Schema::dropIfExists('our_work_translations');
    }
}
