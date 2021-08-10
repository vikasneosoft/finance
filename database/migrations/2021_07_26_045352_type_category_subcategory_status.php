<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeCategorySubcategoryStatus extends Migration
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
            CREATE VIEW type_category_subcategory_status AS
            SELECT financial_years.year, budget_types.name AS TYPE, budget_categories.name AS cat_name, budget_sub_categories.name AS sub_cat_name, SUM(budget_details.budget_amount) AS budget_amount, SUM(expense_details.expense_amount) AS expense_amount, budgets.employee_id, budgets.`company_id`,budgets.`location_id`,budgets.`division_id`, budgets.`department_id`, budgets.`section_id` FROM `budgets` JOIN `budget_details` ON budgets.id = budget_details.budget_id JOIN `financial_years` ON budgets.financial_year = financial_years.id LEFT JOIN(SELECT expensives.id,budget_subcategory_id, expensives.budget_id,expensives.budget_type_id, expensive_details.budget_detail_id, SUM(expensive_details.expensive_amount ) AS expense_amount FROM expensives JOIN `expensive_details` ON expensives.id = expensive_details.expensive_id WHERE expensives.submited = 1 AND expensives.is_approved IN(0, 1) GROUP BY budget_subcategory_id ) expense_details ON expense_details.budget_detail_id = budget_details.id JOIN `budget_categories` ON budget_categories.id = budget_details.budget_category_id JOIN `budget_sub_categories` ON budget_sub_categories.id = budget_details.budget_subcategory_id JOIN `budget_types` ON budgets.budget_type_id = budget_types.id GROUP BY budget_details.budget_subcategory_id
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

            DROP VIEW IF EXISTS `type_category_subcategory_status`;
            SQL;
    }
}
