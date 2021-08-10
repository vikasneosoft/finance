<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBudgetDetailIdExpensive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expensive_details', function (Blueprint $table) {
            $table->integer('budget_detail_id')->after('budget_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expensive_details', function (Blueprint $table) {
            $table->dropColumn('budget_detail_id');
        });
    }
}
