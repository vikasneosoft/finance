<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnExpensesSubmit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expensives', function (Blueprint $table) {
            $table->integer('company_id')->after('employee_id');
            $table->integer('division_id')->after('company_id');
            $table->integer('department_id')->after('division_id');
            $table->integer('section_id')->after('department_id');
            $table->boolean('submited')->after('location_id')->comment('0=>not,1=>yes');
            $table->integer('is_approved')->nullable()->after('submited')->comment('0=>pending,1=>approved,2=>rejected');
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
            $table->dropColumn('company_id');
            $table->dropColumn('division_id');
            $table->dropColumn('department_id');
            $table->dropColumn('section_id');
            $table->dropColumn('submited');
            $table->dropColumn('is_approved');
        });
    }
}
