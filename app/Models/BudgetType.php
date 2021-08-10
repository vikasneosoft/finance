<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetType extends Model
{
    use HasFactory;
    protected $table = 'budget_types';
    protected $fillable = ['name'];


    /**
     * Get all budget types
     *
     *
     * @return array
     */
    function getBudgetTypes()
    {
        return $this::select('id', 'name')
            ->orderby('id', 'desc')
            ->get();
    }


    /**
     * Get BudgetType
     *
     * @param  $id
     * @return array
     */
    function getBudgetType($id)
    {
        return $this::find($id);
    }

    /**
     * Get BudgetTypes by pluck
     *
     *
     * @return array
     */
    function getBudgetTypesByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }

    /**
     * Store BudgetType
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addBudgetType($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update BudgetType
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateBudgetType($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete BudgetType
     *
     * @param  $id
     * @return true
     */
    function deleteBudgetType($id)
    {
        return $this::where(array('id' => $id))->delete();
    }
}
