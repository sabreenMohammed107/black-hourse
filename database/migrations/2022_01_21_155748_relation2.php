<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relation2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  This is Realations for the student_rounds Table ..
        Schema::table('student_rounds', function (Blueprint $table) {
            $table->foreign('round_id')->references('id')->on('rounds');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('status_id')->references('id')->on('request_statuses');
            $table->foreign('certificate_status_id')->references('id')->on('certificate_statuses');

        });

         //  This is Realations for the students Table ..
         Schema::table('students', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('sale_fannel_id')->references('id')->on('sale_funnels');
            $table->foreign('request_status_id')->references('id')->on('request_statuses');

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
