<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemModeratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_moderator', function (Blueprint $table) {
            $table->foreignId('problem_id')->references('id')->on('problems')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->enum('role', ['owner','moderator'])->default('moderator');
            $table->boolean('is_accepted')->default(false);

            $table->primary(['problem_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem_moderator');
    }
}
