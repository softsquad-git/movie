<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('user_id')->index();
            $table->integer('category_id')->index();
            $table->string('src');
            $table->integer('status')->default(\App\Helpers\Status::WAITING);
            $table->boolean('is_comment')->default(true);
            $table->boolean('is_rating')->default(true);
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
        Schema::dropIfExists('movies');
    }
}
