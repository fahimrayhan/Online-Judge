<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('problem_description')->nullable();
            $table->text('input_description')->nullable();
            $table->text('output_description')->nullable();
            $table->text('constraint_description')->nullable();
            $table->text('notes')->nullable();
            $table->float('time_limit')->default(2.0);
            $table->integer('memory_limit')->default(128000);
            $table->text('checker')->nullable();
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
        Schema::dropIfExists('problems');
    }
}
