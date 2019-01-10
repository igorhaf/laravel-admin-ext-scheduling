<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTasksTableAddAutoCleanupNumAndTypeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_scheduling_tasks', function (Blueprint $table) {
                $table->integer('auto_cleanup_num')->default(0);
                $table->string('auto_cleanup_type', 20)->nullable();
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
                $table->dropColumn('auto_cleanup_num');
            });

        Schema::table('admin_scheduling_tasks', function (Blueprint $table) {
                $table->dropColumn('auto_cleanup_type');
            });
    }
}
