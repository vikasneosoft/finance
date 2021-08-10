<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ViewBudgetDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW view_budget_details AS
            SELECT budget_details.budget_id, sum(budget_details.budget_amount) as budget_amount, sum(expensive_details.expensive_amount) as expense_amount, sum(budget_details.budget_amount) - sum(expensive_details.expensive_amount) as balance  FROM budget_details JOIN `expensive_details` ON budget_details.id = expensive_details.budget_detail_id GROUP BY budget_details.budget_id
            SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `view_budget_details`;
            SQL;
    }
}
