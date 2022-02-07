<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FinancalRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  This is Realations for the cashboxes Table ..
        Schema::table('cashboxes', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches');

        });

        //  This is Realations for the payments Table ..
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('deploma_id')->references('id')->on('deplomas');
            $table->foreign('round_id')->references('id')->on('rounds');
            $table->foreign('cashbox_id')->references('id')->on('cashboxes');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('trainer_id')->references('id')->on('trainers');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
