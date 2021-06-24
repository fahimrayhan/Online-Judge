<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('banner')->nullable();
            $table->enum('format', ['icpc','ioi'])->default('icpc');
            $table->boolean("publish")->default(0);

            $table->enum('visibility', ['public','protected','private'])->default('public');
            $table->string('password')->nullable();

            $table->timestamp("start");
            $table->integer("duration")->default(300);

            $table->boolean("registration_auto_accept")->default(0);
            $table->text('user_data_field')->nullable();

            $table->string('participate_main_name')->nullable();
            $table->string('participate_sub_name')->nullable();


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
        Schema::dropIfExists('contests');
    }
}
