<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBudgetType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->integer('budget_type_id')->after('budget_code');
        });

        Schema::table('budget_details', function (Blueprint $table) {
            $table->dropColumn('budget_type_id');
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
            $table->dropColumn('budget_type_id');
        });

        Schema::table('budget_details', function (Blueprint $table) {
            $table->integer('budget_type_id')->after('employee_id');
        });
    }
}
