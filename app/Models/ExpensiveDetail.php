<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensiveDetail extends Model
{
    use HasFactory;
    protected $table = 'expensive_details';

    protected $fillable = ['expensive_id', 'budget_id', 'budget_detail_id', 'budget_category_id', 'specifications', 'image', 'budget_subcategory_id', 'expensive_for', 'expensive_quantity', 'expensive_rate', 'expensive_amount', 'expensive_explanation','budget_amt','submited_expense','expense_balance','is_rejected'];


    /**
     * Get all expensive details by expensive id
     *
     * @param expensiveId
     * @return array
     */
    function getExpensiveDetailsByExpensiveId($expensiceId)
    {
        return $this::with(array('budgetCategory', 'budgetSubcategory'))
            ->where(array('expensive_id' => $expensiceId))
            ->select('id', 'expensive_id', 'budget_id','budget_detail_id','budget_category_id', 'specifications', 'image', 'budget_subcategory_id', 'expensive_for', 'expensive_quantity', 'expensive_rate', 'expensive_amount', 'expensive_explanation')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get all expensive details by budget id
     *
     * @param expensiveId
     * @return array
     */
    function getExpenseDetailsByBudgetId($budgetId)
    {
        return $this::with(array('budgetCategory', 'budgetSubcategory'))
            ->where(array('budget_id' => $budgetId))
            ->select('id', 'expensive_id', 'budget_category_id', 'specifications', 'image', 'budget_subcategory_id', 'expensive_for', 'expensive_quantity', 'expensive_rate', 'expensive_amount', 'expensive_explanation')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get Expensive detail by id
     *
     * @param  $id
     * @return array
     */
    function getExpensiveDetail($id)
    {
        return $this::with(array('budgetCategory', 'budgetSubcategory'))
            ->find($id);
    }


    /**
     * Store expensive
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addExpensiveDetail($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Budget detail
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateExpensiveDetail($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Expensive detail
     *
     * @param  $id
     * @return true
     */
    function deleteExpensiveDetail($id)
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
}
