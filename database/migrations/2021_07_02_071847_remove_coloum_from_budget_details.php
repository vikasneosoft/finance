<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColoumFromBudgetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budget_details', function (Blueprint $table) {
            $table->dropColumn('budget_from_date');
            $table->dropColumn('budget_to_date');
            $table->dropColumn('budget_vendor');
            $table->dropColumn('budget_proj_ref_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_details', function (Blueprint $table) {
            $table->dateTime('budget_from_date');
            $table->dateTime('budget_to_date');
            $table->string('budget_vendor');
            $table->string('budget_proj_ref_no');
        });
    }
}
