<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expensives', function (Blueprint $table) {
            $table->integer('location_id')->after('project_in_charge')->nullable();
            $table->string('what_is_required')->after('proj_ref_no')->nullable();
            $table->string('why_required')->after('what_is_required')->nullable();
            $table->string('scope_of_work')->after('why_required')->nullable();
            $table->string('what_will_change')->after('scope_of_work')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expensives', function (Blueprint $table) {
            $table->dropColumn('location_id');
            $table->dropColumn('what_is_required');
            $table->dropColumn('why_required');
            $table->dropColumn('scope_of_work');
            $table->dropColumn('what_will_change');
        });
    }
}
