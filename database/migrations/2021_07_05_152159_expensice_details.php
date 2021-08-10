<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpensiceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expensive_details', function (Blueprint $table) {
            $table->id();
            $table->integer('expensive_id');
            $table->integer('budget_id');
            $table->integer('budget_category_id');
            $table->integer('budget_subcategory_id');
            $table->string('expensive_for');
            $table->double('expensive_quantity');
            $table->double('expensive_rate');
            $table->double('expensive_amount');
            $table->text('expensive_explanation')->nullable();
            $table->text('specifications');
            $table->text('image')->nullable();
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
        Schema::dropIfExists('expensive_details');
    }
}
