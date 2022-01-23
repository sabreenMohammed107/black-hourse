<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('n_id')->nullable();
            $table->string('email')->nullable();
            $table->string('education')->nullable();
            $table->string('job')->nullable();
            $table->dateTime('register_date',0)->nullable();
            $table->foreignId('company_id')->nullable();
            $table->integer('age')->nullable();
            $table->foreignId('sale_fannel_id')->nullable();
            $table->foreignId('request_status_id')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('students');
    }
}
