<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RountingStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounting_status', function (Blueprint $table) {
            $table->id();
            $table->integer('expense_id');
            $table->integer('originator_id');
            $table->double('expense_amount');
            $table->integer('subimtted_by');
            $table->integer('approver_id');
            $table->integer('level');
            $table->double('maximum_amount');
            $table->integer('approval_status')->comment('0=>Pending ,1=>approved, 2=>disapproved');
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('rounting_status');
    }
}
