<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_rounds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('round_id')->nullable();
            $table->foreignId('student_id')->nullable();
            $table->dateTime('register_date',0)->nullable();
            $table->double('total_fees',11,2)->nullable();
            $table->double('total_paid',11,2)->nullable();
            $table->foreignId('status_id')->nullable();
            $table->foreignId('certificate_status_id')->nullable();
            $table->text('note')->nullable();

            $table->integer('deploma_flag')->nullable();
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
        Schema::dropIfExists('student_rounds');
    }
}
