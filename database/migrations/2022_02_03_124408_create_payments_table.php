<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_balance_date',0)->nullable();
            $table->foreignId('deploma_id')->nullable();
            $table->foreignId('round_id')->nullable();
            $table->double('amount',11,2)->nullable();
            $table->foreignId('cashbox_id')->nullable();
            $table->foreignId('student_id')->nullable();
            $table->foreignId('trainer_id')->nullable();
            $table->foreignId('employee_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('payment_type_id')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
