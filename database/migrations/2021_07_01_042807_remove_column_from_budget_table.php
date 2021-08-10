<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnFromBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('budget_type_id');
            $table->dropColumn('budget_category_id');
            $table->dropColumn('budget_subcategory_id');
            $table->dropColumn('budget_for');
            $table->dropColumn('budget_quantity');
            $table->dropColumn('budget_rate');
            $table->dropColumn('budget_amount');
            $table->dropColumn('budget_explanation');
            $table->dropColumn('specifications');
            $table->dropColumn('image');
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
        Schema::table('budgets', function (Blueprint $table) {
            $table->integer('budget_type_id');
            $table->integer('budget_category_id');
            $table->integer('budget_subcategory_id');
            $table->string('budget_for');
            $table->double('budget_quantity');
            $table->double('budget_rate');
            $table->double('budget_amount');
            $table->text('budget_explanation')->nullable();
            $table->text('specifications');
            $table->text('image');
            $table->dateTime('budget_from_date');
            $table->dateTime('budget_to_date');
            $table->string('budget_vendor');
            $table->string('budget_proj_ref_no');
        });
    }
}
