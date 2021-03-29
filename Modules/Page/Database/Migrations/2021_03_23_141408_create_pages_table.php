<?php            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_h1')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('prefix')->unique();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        Schema::create('page_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rowId')->unsigned();
            $table->string('name');
            $table->text('content');
            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_h1')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

            $table->bigInteger('languageId')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_translations');
    }
}
