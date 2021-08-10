<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ViewBudgetForExpense extends Migration
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
            CREATE VIEW view_budget_for_expense AS
            SELECT financial_years.year,budgets.id,cost_centers.name AS cost_center,budget_types.name AS budget_type,project_codes.code AS project_code,users.name AS created_by,`project_in_charge`,SUM(budget_details.budget_amount) AS budget,SUM(expense_detail.expense) AS expense,budgets.company_id, budgets.location_id,budgets.division_id, budgets.department_id,budgets.section_id,budgets.employee_id FROM budgets JOIN( SELECT `budget_id`,SUM(`budget_amount`) AS budget_amount FROM `budget_details` GROUP BY budget_id ) budget_details ON budgets.id = budget_details.budget_id LEFT JOIN( SELECT expensives.budget_id,SUM( expensive_details.expensive_amount ) AS expense FROM expensives JOIN `expensive_details` ON expensives.id = expensive_details.expensive_id WHERE expensives.submited = 1 AND expensives.is_approved IN(0, 1) GROUP BY expensive_details.budget_id ) expense_detail ON budgets.id = expense_detail.budget_id JOIN financial_years ON financial_years.id = budgets.financial_year JOIN cost_centers ON cost_centers.id = budgets.cost_center_id JOIN budget_types ON budget_types.id = budgets.budget_type_id JOIN project_codes ON project_codes.id = budgets.project_code_id JOIN users ON users.id = budgets.employee_id GROUP BY budgets.id
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

            DROP VIEW IF EXISTS `view_budget_for_expense`;
            SQL;
    }
}
