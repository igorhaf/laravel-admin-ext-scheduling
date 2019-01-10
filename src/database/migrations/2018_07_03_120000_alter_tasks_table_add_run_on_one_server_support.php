<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTasksTableAddRunOnOneServerSupport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_scheduling_tasks', function (Blueprint $table) {
                $table->boolean('run_on_one_server')->default(false);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_scheduling_tasks', function (Blueprint $table) {
                $table->dropColumn('run_on_one_server');
            });
    }
}
