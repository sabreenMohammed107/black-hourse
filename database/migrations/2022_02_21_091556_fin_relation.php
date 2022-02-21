<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FinRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  This is Realations for the invoices Table ..
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('deploma_id')->references('id')->on('deplomas');
            $table->foreign('round_id')->references('id')->on('rounds');
            $table->foreign('cashbox_id')->references('id')->on('cashboxes');
            $table->foreign('user_id')->references('id')->on('users');

        });

        //  This is Realations for the financial_entries Table ..
        Schema::table('financial_entries', function (Blueprint $table) {
            $table->foreign('enrty_type_id')->references('id')->on('fin_entery_types');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('payment_id')->references('id')->on('payments');


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
