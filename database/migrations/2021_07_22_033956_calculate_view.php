<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalculateView extends Migration
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
            CREATE VIEW view_expense_details AS
            SELECT budget_details.id,budget_details.budget_for,budget_details.budget_id,budget_details.budget_rate,budget_categories.name AS cat_name,budget_sub_categories.name AS sub_cat_name,SUM(budget_details.budget_quantity) AS budget_quantity, SUM(expense_detail.expense_quantity) AS expense_quantity, SUM(budget_details.budget_quantity) - SUM( expense_detail.expense_quantity ) AS remain_qty, SUM(budget_details.budget_amount) AS budget_amount, SUM(expense_detail.expense_amount ) AS expense_amount,SUM(budget_details.budget_amount) - SUM(expense_detail.expense_amount ) AS balance FROM budget_details LEFT JOIN (SELECT expensives.submited, expensive_details.budget_id,expensive_details.budget_detail_id,SUM(expensive_details.expensive_quantity) AS expense_quantity, SUM(expensive_details.expensive_amount) AS expense_amount FROM expensives JOIN `expensive_details` ON expensives.id = expensive_details.expensive_id WHERE expensives.submited = 1 AND expensives.is_approved IN(0, 1) GROUP BY expensive_details.budget_detail_id) expense_detail ON budget_details.id = expense_detail.budget_detail_id JOIN `budget_categories` ON budget_categories.id = budget_details.budget_category_id JOIN `budget_sub_categories` ON budget_sub_categories.id = budget_details.budget_subcategory_id GROUP BY budget_details.id
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

            DROP VIEW IF EXISTS `view_expense_details`;
            SQL;
    }
}
