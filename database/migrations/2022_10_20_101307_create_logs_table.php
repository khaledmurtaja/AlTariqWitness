<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('associatable_type');
            $table->unsignedBigInteger('associatable_id');
            $table->integer('action_type');// 0 Uploaded, 1 Edited,  2 Extracted, 3 Cancelled
            $table->string('ip_address', 80);
            $table->string('country');
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->timestamp('log_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
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
        Schema::dropIfExists('logs');
    }
};
