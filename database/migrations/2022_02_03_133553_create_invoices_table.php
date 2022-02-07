<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->dateTime('invoice_date',0)->nullable();
            $table->foreignId('student_id')->nullable();
            $table->foreignId('payment_type_id')->nullable();
            $table->foreignId('deploma_id')->nullable();
            $table->foreignId('round_id')->nullable();
            $table->double('total_required_fees',11,2)->nullable();
            $table->double('total_paid_before',11,2)->nullable();
            $table->double('total_fees_new',11,2)->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('cashbox_id')->nullable();
            $table->text('notes')->nullable();
            $table->text('system_notes')->nullable();

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
        Schema::dropIfExists('invoices');
    }
}
