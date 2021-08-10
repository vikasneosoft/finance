<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Views\ViewExpenseDetail;

use DB;

class Expensive extends Model
{
    use HasFactory;
    protected $table = 'expensives';
    protected $fillable = ['id', 'budget_id', 'employee_id', 'budget_type_id', 'financial_year', 'from_date', 'to_date', 'vendor', 'vendor_contacts', 'reason_for_selecting_vendor', 'assumptions_or_inclusions', 'exceptions_or_exclusions', 'payment_terms', 'warranty_guarantee_details', 'expensive_code', 'cost_center_id', 'project_code_id', 'project_in_charge', 'proj_ref_no', 'location_id', 'what_is_required', 'why_required', 'scope_of_work', 'what_will_change', 'submited', 'is_approved', 'company_id', 'division_id', 'department_id', 'section_id', 'is_cloned'];


    /**
     * Get all expensives
     *
     * @return array
     */
    function getExpensives()
    {
        return $this::with(array('employee'))
            ->select('id', 'employee_id')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get all submitted expensives by underworking employes
     *
     * @return array
     */
    function getAllExpensesOfEmployes($companyIds, $divisionIds, $locationIds, $departmentIds, $sectionIds)
    {
        return $this::with(array('expenseDetail','costCenter', 'projectCode', 'financialYear', 'budgetType', 'expensesSum', 'pendingLevel', 'employee','budgetSum','submittedExpensesSum'))
            //->where(array('submited' => 1))
            ->whereIn('company_id', $companyIds)
            ->whereIn('division_id', $divisionIds)
            ->whereIn('department_id', $departmentIds)
            ->when($sectionIds, function ($query, $sectionIds) {
                return $query->whereIn('section_id', $sectionIds);
            })
            ->join('view_budget_details', 'view_budget_details.budget_id', 'expensives.budget_id')
            ->select('id','expensives.budget_id', 'employee_id', 'financial_year', 'cost_center_id', 'project_code_id', 'project_in_charge', 'budget_type_id', 'is_approved', 'submited', 'view_budget_details.budget_amount', 'view_budget_details.balance')
            ->orderby('id', 'desc')
            ->get();
    }



    /**
     * Get all Expensive by user id
     *
     * @return array
     */
    function getExpensivesByUserId($userId)
    {
        return $this::with(array('employee', 'costCenter', 'projectCode', 'financialYear', 'budgetType', 'expensesSum', 'pendingLevel','budgetSum','submittedExpensesSum'))
            ->where(array('employee_id' => $userId, 'submited' => 1, 'is_approved' => 0))
            //->join('view_budget_details', 'view_budget_details.budget_id', 'expensives.budget_id')
            ->select('id','expensives.budget_id' ,'employee_id', 'financial_year', 'cost_center_id', 'project_code_id', 'project_in_charge', 'budget_type_id', 'is_approved', 'created_at')
            //->select('id','expensives.budget_id' ,'employee_id', 'financial_year', 'cost_center_id', 'project_code_id', 'project_in_charge', 'budget_type_id', 'is_approved', 'created_at', 'view_budget_details.budget_amount', 'view_budget_details.balance')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get all expensive details by expensive id
     *
     * @param expensiveId
     * @return array
     */
    function getExpensivesByBudgetId($budgetId)
    {
        return $this::with(array('expenseDetail'))
            ->where(array('budget_id' => $budgetId))
            ->select('id', 'budget_id', 'employee_id', 'budget_type_id', 'financial_year', 'from_date', 'to_date', 'vendor', 'vendor_contacts', 'reason_for_selecting_vendor', 'assumptions_or_inclusions', 'exceptions_or_exclusions', 'payment_terms', 'warranty_guarantee_details', 'expensive_code', 'cost_center_id', 'project_code_id', 'project_in_charge', 'proj_ref_no', 'submited', 'is_approved', 'is_cloned')
            ->first();
    }

    /**
     * Get expenses that are waiting for approval
     *
     * @param expensiveId
     * @return array
     */
    public function getSubmitedExpensesForApproval($approverId)
    {
        return $this::with(array('costCenter', 'projectCode', 'financialYear', 'budgetType', 'employee','budgetSum','submittedExpensesSum','expensesSum'))
            ->join('rounting_status', 'rounting_status.expense_id', 'expensives.id')
            //->join('view_budget_details', 'view_budget_details.budget_id', 'expensives.budget_id')
            ->where(array('rounting_status.approval_status' => 0, 'rounting_status.approver_id' => $approverId))
            ->select('expensives.id','expensives.budget_id' ,'financial_year', 'expensives.budget_id', 'expensive_code', 'budget_type_id', 'cost_center_id', 'project_code_id', 'rounting_status.expense_amount', 'rounting_status.approval_status', 'budget_type_id', 'employee_id')
            //->select('expensives.id','expensives.budget_id' ,'financial_year', 'expensives.budget_id', 'expensive_code', 'budget_type_id', 'cost_center_id', 'project_code_id', 'rounting_status.expense_amount', 'rounting_status.approval_status', 'budget_type_id', 'employee_id', 'view_budget_details.budget_amount', 'view_budget_details.balance')
            ->get();
    }

    public function bk_before_view_getSubmitedExpensesForApproval($approverId)
    {
        return $this::with(array('costCenter', 'projectCode', 'financialYear', 'budgetType', 'employee', 'budgetSum'))
            ->join('rounting_status', 'rounting_status.expense_id', 'expensives.id')
            ->where(array('rounting_status.approval_status' => 0, 'rounting_status.approver_id' => $approverId))
            ->select('expensives.id', 'financial_year', 'expensives.budget_id', 'expensive_code', 'budget_type_id', 'cost_center_id', 'project_code_id', 'rounting_status.expense_amount', 'rounting_status.approval_status', 'budget_type_id', 'employee_id')
            ->get();
    }

    public function bk_getSubmitedExpensesForApproval($budgetId, $approverId)
    {
        return $this::with(array('costCenter', 'projectCode', 'financialYear', 'budgetType'))
            ->join('rounting_status', 'rounting_status.expense_id', 'expensives.id')
            ->where(array('expensives.budget_id' => $budgetId, 'rounting_status.approver_id' => $approverId))
            ->select('expensives.id', 'financial_year', 'expensive_code', 'budget_type_id', 'cost_center_id', 'project_code_id', 'rounting_status.expense_amount', 'rounting_status.approval_status', 'budget_type_id')
            ->get()->toArray();
    }

    /**
     * Get expenses that are waiting for approval
     *
     * @param expensiveId
     * @return array
     */
    public function getExpensesDetailForApproval($expenseId)
    {
        return $this::with(array('expenseDetail', 'employee', 'financialYear', 'costCenter', 'projectCode', 'budgetType', 'budgetSum', 'expensesSum', 'totalExpense'))
            ->where(array('id' => $expenseId))
            ->first()
            ->toArray();
    }

    /**
     * Get expenses that are waiting for approval
     *
     * @param expensiveId
     * @return array
     */
    public function getSubmitedExpensesDetail($expenseId, $employeID)
    {
        return $this::with(array('expenseDetail', 'employee', 'financialYear', 'costCenter', 'projectCode', 'budgetType', 'rejectReason', 'pendingLevel','submittedExpensesSum'))
            ->where(array('id' => $expenseId, 'employee_id' =>  $employeID))->first()->toArray();
    }

    /**
     * Get clone expense by budget id
     *
     * @param expensiveId
     * @return array
     */
    function getClonedExpenseByBudgetId($budgetId)
    {
        return $this::with(array('expenseDetail'))
            ->where(array('budget_id' => $budgetId, 'is_cloned' => 0))
            ->select('id', 'budget_id', 'employee_id', 'budget_type_id', 'financial_year', 'from_date', 'to_date', 'vendor', 'vendor_contacts', 'reason_for_selecting_vendor', 'assumptions_or_inclusions', 'exceptions_or_exclusions', 'payment_terms', 'warranty_guarantee_details', 'expensive_code', 'cost_center_id', 'project_code_id', 'project_in_charge', 'proj_ref_no', 'submited', 'is_approved', 'is_cloned')
            ->first();
    }


    /**
     * Get all expensive details by expensive id
     *
     * @param expensiveId
     * @return array
     */
    function getExpensesByBudgetAndUserId($budgetId)
    {
        return $this::with(array('employee', 'expenseDetail', 'expensesSum', 'costCenter', 'projectCode', 'financialYear', 'budgetType','budgetSum'))
            ->where(array('budget_id' => $budgetId))
            ->select('id', 'budget_id', 'employee_id', 'budget_type_id', 'financial_year', 'from_date', 'to_date', 'vendor', 'vendor_contacts', 'reason_for_selecting_vendor', 'assumptions_or_inclusions', 'exceptions_or_exclusions', 'payment_terms', 'warranty_guarantee_details', 'expensive_code', 'cost_center_id', 'project_code_id', 'project_in_charge', 'proj_ref_no', 'created_at', 'submited', 'is_approved')
            ->orderBy('id','DESC')
            ->get();
    }

    function bk_getExpensesByBudgetAndUserId($budgetId, $userId)
    {
        return $this::with(array('employee', 'expenseDetail', 'expensesSum', 'costCenter', 'projectCode', 'financialYear', 'budgetType'))
            ->where(array('budget_id' => $budgetId, 'employee_id' => $userId))
            ->select('id', 'budget_id', 'employee_id', 'budget_type_id', 'financial_year', 'from_date', 'to_date', 'vendor', 'vendor_contacts', 'reason_for_selecting_vendor', 'assumptions_or_inclusions', 'exceptions_or_exclusions', 'payment_terms', 'warranty_guarantee_details', 'expensive_code', 'cost_center_id', 'project_code_id', 'project_in_charge', 'proj_ref_no', 'created_at', 'submited')
            ->get();
    }

    /**
     * Get Expensive by id
     *
     * @param  $id
     * @return array
     */
    function getExpensive($id)
    {
        return $this::with(array('expenseDetail'))
            ->find($id);
    }


    /**
     * Store Expensive
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addExpensive($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Expensive
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateExpensive($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Expensive
     *
     * @param  $id
     * @return true
     */
    function deleteExpensive($id)
    {
        return $this::where(array('id' => $id))->delete();
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
     * Get the expense detail
     */
    function expenseDetail()
    {
        return $this->hasMany(ExpensiveDetail::class, 'expensive_id', 'id')
            ->join('budget_categories', 'budget_categories.id', '=', 'expensive_details.budget_category_id')
            ->join('budget_sub_categories', 'budget_sub_categories.id', '=', 'expensive_details.budget_subcategory_id')
            ->join('budget_details', 'budget_details.id', '=', 'expensive_details.budget_detail_id')
            ->select(array('expensive_details.id', 'expensive_id', 'expensive_for', 'expensive_details.specifications', 'expensive_details.image', 'expensive_quantity', 'expensive_rate', 'expensive_amount', 'expensive_explanation', 'budget_categories.name as category_name', 'budget_sub_categories.name as subcategory_name','budget_amt','submited_expense','expense_balance','budget_details.budget_amount'));
    }

    /**
     * Get the budget sum
     */
    function expensesSum()
    {
        return $this->hasOne(ExpensiveDetail::class, 'expensive_id', 'id')
            ->select(array('expensive_id', DB::raw("SUM(expensive_amount) as expensive_amount")))
            ->groupBy("expensive_id");
    }


    /**
     * Get the submitted expense amount sum
     */
    function submittedExpensesSum()
    {
        return $this->hasOne(ViewExpenseDetail::class, 'budget_id', 'budget_id')
            ->select(array('budget_id', DB::raw("SUM(expense_amount) as expense_amount")))
            ->groupBy("budget_id");
    }

    /**
     * Get the budget sum
     */
    function totalExpense()
    {
        return $this->hasOne(ExpensiveDetail::class, 'budget_id', 'budget_id')
            ->select(array('budget_id', DB::raw("SUM(expensive_amount) as expensive_amount")))
            ->groupBy("budget_id");
    }

    /**
     * Get the budget sum
     */
    function budgetSum()
    {
        return $this->hasOne(BudgetDetail::class, 'budget_id', 'budget_id')
            ->select(array('budget_id', DB::raw("SUM(budget_amount) as budget_amount")))
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

    /**
     * Get the budget detail
     */
    function rejectReason()
    {
        return $this->hasOne(RountingStatus::class, 'expense_id', 'id')
            ->where(array('approval_status' => 2))
            ->join('users', 'users.id', 'rounting_status.rejected_by')
            ->select(array('expense_id', 'reason',  'users.name'));
    }

    /**
     * Get the pending level
     */
    function pendingLevel()
    {
        return $this->hasMany(RountingStatus::class, 'expense_id', 'id')
        ->join('users','users.id','=','rounting_status.approver_id')
        ->select(array('users.name','expense_id', 'level','approval_status','reason','rounting_status.created_at'));
    }


}
