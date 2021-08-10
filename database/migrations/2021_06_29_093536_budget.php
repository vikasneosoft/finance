<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Budget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('financial_year', 10);
            $table->integer('section_id');
            $table->integer('department_id');
            $table->integer('division_id');
            $table->integer('location_id');
            $table->integer('company_id');
            $table->integer('budget_type_id');
            $table->integer('budget_category_id');
            $table->integer('budget_subcategory_id');
            $table->string('budget_for');
            $table->double('budget_quantity');
            $table->double('budget_rate');
            $table->double('budget_amount');
            $table->text('budget_explanation')->nullable();
            $table->dateTime('budget_from_date');
            $table->dateTime('budget_to_date');
            $table->string('budget_vendor');
            $table->string('budget_proj_ref_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
