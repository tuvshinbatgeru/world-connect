<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('cover_url');
            $table->tinyInteger('type'); //1 - news, 2 - zar, 3 - tetgeleg
            $table->integer('country_id')->unsigned()->index();
            $table->integer('visit_count')->unsigned();
            $table->tinyInteger('view_order')->default(0);
            $table->enum('is_pinned', ['N', 'Y'])->default('N'); 
            $table->enum('is_active', ['N', 'Y'])->default('Y'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
;