<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Approval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('employe_id');
            $table->string('level_one_id');
            $table->string('level_one_max');
            $table->string('level_two_id');
            $table->string('level_two_max');
            $table->string('level_three_id');
            $table->string('level_three_max');
            $table->string('level_four_id');
            $table->string('level_four_max');
            $table->string('level_five_id');
            $table->string('level_five_max');
            $table->dateTime('approval_date')->nullable();
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
        Schema::dropIfExists('approval_lists');
    }
}
