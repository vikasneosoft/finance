<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Budget extends Model
{
    use HasFactory;
    protected $table = 'budgets';
    protected $fillable = ['id', 'employee_id', 'budget_type_id', 'financial_year', 'budget_from_date', 'budget_to_date', 'vendor', 'vendor_contacts', 'budget_code', 'cost_center_id', 'project_code_id', 'project_in_charge', 'budget_proj_ref_no', 'company_id', 'location_id', 'division_id', 'department_id', 'section_id'];


    /**
     * Get all budgets
     *
     * @return array
     */
    function getBudgets()
    {
        return $this::with(array('employee'))
            ->select('id', 'employee_id')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get all budgets by user id
     *
     * @return array
     */
    function getBudgetsByUserId($company_id, $location_id, $division_id, $department_id, $section_id)
    {
        return $this::with(array('employee', 'costCenter', 'projectCode', 'financialYear', 'budgetSum', 'expensesSum'))
            ->where(array('company_id' => $company_id))
            ->when($division_id, function ($query, $division_id) {
                return $query->where('division_id', $division_id);
            })
            ->when($department_id, function ($query, $department_id) {
                return $query->where('department_id', $department_id);
            })
            ->when($section_id, function ($query, $section_id) {
                return $query->where('section_id', $section_id);
            })
            ->select('id', 'financial_year', 'cost_center_id', 'project_code_id', 'project_in_charge', 'employee_id')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get all budgets by user id
     *
     * @return array
     */
    function bk_getBudgetsByUserId($userId)
    {
        return $this::with(array('employee', 'costCenter', 'projectCode', 'financialYear', 'budgetSum', 'expensesSum'))
            ->where(array('employee_id' => $userId))
            ->select('id', 'financial_year', 'cost_center_id', 'project_code_id', 'project_in_charge', 'employee_id')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get all budgets for expenses
     *
     * @return array
     */


    function getBudgetsForExpense($company_id, $location_id, $division_id, $department_id, $section_id)
    {

        return $this::with(array('employee', 'costCenter', 'projectCode', 'financialYear', 'budgetSum', 'expensesSum'))
            ->where(array('company_id' => $company_id))
            ->when($division_id, function ($query, $division_id) {
                return $query->where('division_id', $division_id);
            })
            ->when($department_id, function ($query, $department_id) {
                return $query->where('department_id', $department_id);
            })
            ->when($section_id, function ($query, $section_id) {
                return $query->where('section_id', $section_id);
            })
            ->select('id', 'employee_id', 'financial_year', 'cost_center_id', 'project_code_id', 'project_in_charge')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get budget
     *
     * @param  $id
     * @return array
     */
    function getBudget($id)
    {
        return $this::with(array('financialYear', 'costCenter', 'projectCode', 'budgetType', 'budgetDetail', 'expenseDetail'))
            ->find($id);
    }

    /**
     * Get budget by subcategory id
     *
     * @param  $id
     * @return array
     */
    function getBudgetBySubcategoryId($subcategoryId)
    {
        return $this::where(array('budget_subcategory_id' => $subcategoryId))->first();
    }

    /**
     * Get all submitted expenses againset budget
     *
     * @return array
     */
    function getSubmittedExpenses($approverId)
    {
        return $this::with(array('financialYear', 'budgetType', 'costCenter', 'projectCode', 'budgetSum', 'employee'))
            ->join('expensives', 'expensives.budget_id', 'budgets.id')
            ->join('rounting_status', 'rounting_status.expense_id', 'expensives.id')
            ->where(array('rounting_status.approver_id' => $approverId))
            ->select('budgets.id', 'budgets.budget_type_id', 'budgets.cost_center_id', 'budgets.project_code_id', 'budgets.employee_id', 'budgets.financial_year', 'budgets.budget_code', DB::raw("SUM(rounting_status.expense_amount) as expense_amount"))
            ->groupBy('budgets.id')
            ->get();
    }

    /**
     * Store Budget
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addBudget($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Budget
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateBudget($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Budget
     *
     * @param  $id
     * @return true
     */
    function deleteBudget($id)
    {
        return $this::where(array('id' => $id))->delete();
    }


    /**
     * Get the name of category
     */
    function budgetCategory()
    {
        return $this->belongsTo(BudgetCategory::class, 'budget_category_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of subcategory
     */
    function budgetSubcategory()
    {
        return $this->belongsTo(BudgetSubcategory::class, 'budget_subcategory_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of Cost centers
     */
    function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of project code
     */
    function projectCode()
    {
        return $this->belongsTo(ProjectCode::class, 'project_code_id', 'id')
            ->select(array('id', 'code'));
    }

    /**
     * Get the name of financial year
     */
    function financialYear()
    {
        return $this->belongsTo(FinancialYear::class, 'financial_year', 'id')
            ->select(array('id', 'year'));
    }

    /**
     * Get the name of budget type
     */
    function budgetType()
    {
        return $this->belongsTo(BudgetType::class, 'budget_type_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the budget detail
     */
    function budgetDetail()
    {
        return $this->hasMany(BudgetDetail::class, 'budget_id', 'id')
            ->join('budget_categories', 'budget_categories.id', '=', 'budget_details.budget_category_id')
            //->leftjoin('expensive_details', 'expensive_details.budget_detail_id', '=', 'budget_details.id')
            ->join('budget_sub_categories', 'budget_sub_categories.id', '=', 'budget_details.budget_subcategory_id')
            ->select(array('budget_details.id', 'budget_details.budget_id', 'budget_for', 'budget_details.specifications', 'budget_details.image', 'budget_quantity', 'budget_rate', 'budget_amount', 'budget_explanation', 'budget_categories.name as category_name', 'budget_categories.name as category_name', 'budget_sub_categories.name as subcategory_name'));
    }

    function expenseDetail()
    {
        return $this->hasMany(ExpensiveDetail::class, 'budget_id', 'id')
            ->groupBy('budget_detail_id')
            ->select(array(
                'budget_id', 'budget_detail_id',
                DB::raw("SUM(expensive_quantity) as quantity"),
                DB::raw("SUM(expensive_amount) as amount")
            ));
    }

    /**
     * Get the budget sum
     */
    function budgetSum()
    {
        return $this->hasOne(BudgetDetail::class, 'budget_id', 'id')
            ->select(array('budget_id', DB::raw("SUM(budget_amount) as budget_amount")))
            ->groupBy("budget_id");
    }

    /**
     * Get the expenses sum
     */
    function expensesSum()
    {
        return $this->hasOne(ExpensiveDetail::class, 'budget_id', 'id')
            ->select(array('budget_id', DB::raw("SUM(expensive_amount) as expensive_amount")))
            ->groupBy("budget_id");
    }

    /**
     * Get the budget detail
     */
    function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id')
            ->select(array('id', 'name'));
    }
}
