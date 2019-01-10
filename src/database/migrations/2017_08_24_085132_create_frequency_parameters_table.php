<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrequencyParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_scheduling_frequency_parameters', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('frequency_id');
                $table->string('name');
                $table->string('value');
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
        Schema::dropIfExists('admin_scheduling_frequency_parameters');
    }
}
