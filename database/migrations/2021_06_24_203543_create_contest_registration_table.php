<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_registration', function (Blueprint $table) {
            $table->mediumText('registration_data')->nullable();
            $table->boolean("is_registration_accepted")->default(0);
            $table->boolean("is_temp_user")->default(0);
            $table->text('temp_user_password')->nullable();
            $table->timestamps();

            $table->foreignId('contest_id')->references('id')->on('contests')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->primary(['contest_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_registration');
    }
}
