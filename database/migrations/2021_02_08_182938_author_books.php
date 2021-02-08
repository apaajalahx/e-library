<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuthorBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create("author_books",function(Blueprint $table){
        $table->bigIncrements('id');
        $table->bigInteger("books_id")->unsigned();
            $table->foreign("books_id")
                ->references("id")->on("books")
                ->onDelete("cascade");
            $table->bigInteger("author_id")->unsigned();
            $table->foreign("author_id")
                ->references("id")->on("author")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("books_author");
    }
}
