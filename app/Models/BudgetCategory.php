<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    use HasFactory;
    protected $table = 'budget_categories';
    protected $fillable = ['name'];

    /**
     * Get all categories
     *
     *
     * @return array
     */
    function getCategories()
    {
        return $this::select('id', 'name')
            ->orderby('id', 'desc')
            ->get();
    }


    /**
     * Get category
     *
     * @param  $id
     * @return array
     */
    function getCategory($id)
    {
        return $this::find($id);
    }

    /**
     * Get categories by pluck
     *
     *
     * @return array
     */
    function getCategoriesByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }

    /**
     * Store category
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addCategory($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update category
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateCategory($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete category
     *
     * @param  $id
     * @return true
     */
    function deleteCategory($id)
    {
        return $this::where(array('id' => $id))->delete();
    }
}
