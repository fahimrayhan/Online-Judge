<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageProblemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_problem', function (Blueprint $table) {
            $table->foreignId('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreignId('problem_id')->references('id')->on('problems')->onDelete('cascade');
            $table->float('time_limit');
            $table->float('memory_limit');

            $table->primary(['language_id', 'problem_id']);
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
        Schema::dropIfExists('language_problem');
    }
}
