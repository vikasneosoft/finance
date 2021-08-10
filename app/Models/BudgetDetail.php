<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BudgetDetail extends Model
{
    use HasFactory;
    protected $table = 'budget_details';

    protected $fillable = ['employee_id', 'budget_id', 'budget_category_id', 'specifications', 'image', 'budget_subcategory_id', 'budget_for', 'budget_quantity', 'budget_rate', 'budget_amount', 'budget_explanation', 'company_id', 'location_id', 'division_id', 'department_id', 'section_id'];


    /**
     * Get all budgets by user id
     *
     * @return array
     */
    function getBudgetDetailsByBudgetId($budgetId)
    {
        return $this::with(array('budgetCategory', 'budgetSubcategory'))
            ->where(array('budget_id' => $budgetId))
            ->select('id', 'budget_id', 'budget_category_id', 'specifications', 'image', 'budget_subcategory_id', 'budget_for', 'budget_quantity', 'budget_rate', 'budget_amount', 'budget_explanation')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get budget detail
     *
     * @param  $id
     * @return array
     */
    function getBudgetDetail($id)
    {
        return $this::with(array('budgetCategory', 'budgetSubcategory', 'expenseDetail'))
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
     * Store Budget
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addBudgetDetails($inputs)
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
    function updateBudgetDetail($inputs)
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
    function deleteBudgetDetail($id)
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

    function expenseDetail()
    {
        return $this->hasOne(ExpensiveDetail::class, 'budget_detail_id', 'id')
            ->groupBy('budget_detail_id')
            ->select(array(
                'budget_detail_id',
                DB::raw("SUM(expensive_quantity) as quantity"),
                DB::raw("SUM(expensive_amount) as amount")
            ));
    }
}
