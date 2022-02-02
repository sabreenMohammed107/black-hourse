<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_centers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('round_id')->nullable();
            $table->foreign('round_id')->references('id')->on('rounds');

            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedBigInteger('followup_type_id')->nullable();
            $table->foreign('followup_type_id')->references('id')->on('followup_types');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->dateTime('followup_date',0)->nullable();
            $table->text('text')->nullable();
            $table->tinyInteger('followup_flag')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('followup_centers');
    }
}
