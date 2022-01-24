<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions');

            $table->unsignedBigInteger('student_round_id')->nullable();
            $table->foreign('student_round_id')->references('id')->on('student_rounds');

            $table->tinyInteger('is_atend')->nullable();
            $table->double('room_rent_fees',11,2)->nullable();
            $table->double('room_rent_paid',11,2)->nullable();
            $table->double('certificate_fees',11,2)->nullable();
            $table->double('certificate_paid',11,2)->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
