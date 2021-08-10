<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnFromBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('section_id');
            $table->dropColumn('department_id');
            $table->dropColumn('division_id');
            $table->dropColumn('location_id');
            $table->dropColumn('company_id');
            $table->text('specifications')->after('budget_explanation');
            $table->text('image')->after('specifications');
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
            $table->integer('section_id');
            $table->integer('department_id');
            $table->integer('division_id');
            $table->integer('location_id');
            $table->integer('company_id');
            $table->dropColumn('specifications');
            $table->dropColumn('image');
        });
    }
}
