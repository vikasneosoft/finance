<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->string('budget_proj_ref_no')->after('financial_year');
            $table->string('vendor')->after('budget_proj_ref_no');
            $table->string('vendor_contacts')->after('vendor');
            $table->dateTime('budget_from_date')->after('vendor_contacts');
            $table->dateTime('budget_to_date')->after('budget_from_date');
            $table->string('budget_code')->after('budget_to_date');
            $table->integer('cost_center_id')->after('budget_code');
            $table->integer('project_code_id')->after('cost_center_id');
            $table->string('project_in_charge')->after('project_code_id');
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
            $table->dropColumn('budget_proj_ref_no');
            $table->dropColumn('vendor');
            $table->dropColumn('vendor_contacts');
            $table->dropColumn('budget_from_date');
            $table->dropColumn('budget_to_date');
            $table->dropColumn('budget_code');
            $table->dropColumn('cost_center_id');
            $table->dropColumn('project_code_id');
            $table->dropColumn('project_in_charge');
        });
    }
}
