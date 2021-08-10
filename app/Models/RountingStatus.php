<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RountingStatus extends Model
{
    use HasFactory;
    protected $table = 'rounting_status';
    protected $fillable = ['id', 'expense_id', 'originator_id', 'expense_amount', 'subimtted_by', 'approver_id', 'level', 'maximum_amount', 'approval_status', 'reason', 'rejected_by'];

    /**
     * Get all
     *
     *
     * @return array
     */
    function getSubmittedExpenses($expenseId, $approverId)
    {
        return $this::with(array('employee', 'expense'))
            ->where(array('expense_id' => $expenseId, 'approver_id' => $approverId))
            ->get();
    }


    /**
     * Store record for approval
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addForApproval($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Get the name of employee
     */
    function employee()
    {
        return $this->belongsTo(User::class, 'originator_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of employee
     */
    function expense()
    {
        return $this->belongsTo(Expensive::class, 'expense_id', 'id')
            ->join('financial_years', 'financial_years.id', 'expensives.financial_year')
            ->join('budget_types', 'budget_types.id', 'expensives.budget_type_id')
            ->join('cost_centers', 'cost_centers.id', 'expensives.cost_center_id')
            ->join('project_codes', 'project_codes.id', 'expensives.project_code_id')
            ->select(array('expensives.id', 'financial_year', 'financial_years.year', 'budget_types.name as expense_type', 'cost_centers.name as cost_center', 'expensive_code', 'project_codes.code as project_code'));
    }

    /**
     * Get the name of employee who reject expense
     */
    function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by', 'id')
            ->select(array('id', 'name'));
    }
}
