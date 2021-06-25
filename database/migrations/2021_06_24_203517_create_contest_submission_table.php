<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_submission', function (Blueprint $table) {
            $table->foreignId('contest_id')->references('id')->on('contests')->onDelete('cascade');
            $table->foreignId('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->primary(['contest_id', 'submission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_submission');
    }
}
