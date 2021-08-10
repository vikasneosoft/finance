<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetSubcategory extends Model
{
    use HasFactory;
    protected $table = 'budget_sub_categories';
    protected $fillable = ['name', 'budget_category_id'];

    /**
     * Get all sub categories
     *
     *
     * @return array
     */
    function getSubcategories()
    {
        return $this::with(array('category'))
            ->select('id', 'name', 'budget_category_id')
            ->orderby('id', 'desc')
            ->get();
    }


    /**
     * Get subcategory
     *
     * @param  $id
     * @return array
     */
    function getSubcategory($id)
    {
        return $this::find($id);
    }

    /**
     * Get subcategory by category id
     *
     * @param  $id
     * @return array
     */
    function getSubcategoryByCategoryId($categoryId)
    {
        return $this::where(array('budget_category_id' => $categoryId))->first();
    }

    /**
     * Get subcategories by category id
     *
     * @param  $id
     * @return array
     */
    function getSubcategoriesByCategoryId($categoryId)
    {
        return $this::select('id', 'name')
            ->where(array('budget_category_id' => $categoryId))->get();
    }


    /**
     * Store sub category
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addSubcategory($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update sub category
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateSubcategory($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete subcategory
     *
     * @param  $id
     * @return true
     */
    function deleteSubcategory($id)
    {
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get the name of category
     */
    function category()
    {
        return $this->belongsTo(BudgetCategory::class, 'budget_category_id', 'id')
            ->select(array('id', 'name'));
    }
}
