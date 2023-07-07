<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('article_content');
            $table->unsignedBigInteger('author');
            $table->tinyInteger('status')->default(1)->comment('0=Draft,1=Published,2=Deleted');
            $table->string('featured_image')->nullable()->default('featured_image.png');
            $table->string('categories')->default(1);
            $table->string('slug')->default(1);
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
        Schema::dropIfExists('posts');
    }
};
