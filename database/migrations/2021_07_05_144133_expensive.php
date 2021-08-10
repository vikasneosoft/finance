<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Expensive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expensives', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('budget_id');
            $table->integer('financial_year');
            $table->string('proj_ref_no');
            $table->string('vendor');
            $table->string('vendor_contacts');
            $table->text('reason_for_selecting_vendor');
            $table->text('assumptions_or_inclusions');
            $table->text('exceptions_or_exclusions');
            $table->text('payment_terms');
            $table->text('warranty_guarantee_details');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->string('expensive_code');
            $table->integer('budget_type_id');
            $table->integer('cost_center_id');
            $table->integer('project_code_id');
            $table->string('project_in_charge');
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
        Schema::dropIfExists('expensives');
    }
}
