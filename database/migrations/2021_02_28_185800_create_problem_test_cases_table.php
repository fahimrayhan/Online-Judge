<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemTestCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_test_cases', function (Blueprint $table) {
          $table->id();
          $table->string('id_hash',150)->nullable();
          $table->integer('point')->default(1);
          $table->boolean('sample')->default(0);
          $table->timestamps();

          $table->foreignId('problem_id')->references('id')->on('problems')->onDelete('cascade');
          $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem_test_cases');
    }
}
