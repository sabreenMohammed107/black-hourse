<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExeptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exeptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exeption_type_id')->nullable();
            $table->foreign('exeption_type_id')->references('id')->on('exeption_types');

            $table->unsignedBigInteger('deploma_id')->nullable();
            $table->foreign('deploma_id')->references('id')->on('deplomas');

            $table->unsignedBigInteger('round_id')->nullable();
            $table->foreign('round_id')->references('id')->on('rounds');

            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students');

            $table->dateTime('exeption_date',0)->nullable();
            $table->tinyInteger('exeption_status')->nullable();
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
        Schema::dropIfExists('exeptions');
    }
}
