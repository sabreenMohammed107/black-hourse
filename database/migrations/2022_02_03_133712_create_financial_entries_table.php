<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_entries', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_balance_date',0)->nullable();
            $table->foreignId('enrty_type_id')->nullable();
            $table->double('positive',11,2)->nullable();
            $table->double('negative',11,2)->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->foreignId('payment_id')->nullable();
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
        Schema::dropIfExists('financial_entries');
    }
}
