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
        Schema::create('edited_videos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('duration')->nullable();
            $table->string('ip_address', 80);
            $table->string('country');
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edited_videos');
    }
};
