<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdColumnsBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->integer('company_id')->after('employee_id');
            $table->integer('location_id')->after('company_id');
            $table->integer('division_id')->after('location_id');
            $table->integer('department_id')->after('division_id');
            $table->integer('section_id')->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('location_id');
            $table->dropColumn('division_id');
            $table->dropColumn('department_id');
            $table->dropColumn('section_id');
        });
    }
}
