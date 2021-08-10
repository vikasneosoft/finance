<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBudgetExpenseDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expensive_details', function (Blueprint $table) {
            $table->double('budget_amt')->after('expensive_amount');
            $table->double('submited_expense')->after('budget_amt');
            $table->double('expense_balance')->after('submited_expense');
            $table->boolean('is_rejected')->after('image')->comment('0=>not,1=>yes');
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
            $table->dropColumn('budget_amt');
            $table->dropColumn('submited_expense');
            $table->dropColumn('expense_balance');
            $table->dropColumn('is_rejected');
        });
    }
}
