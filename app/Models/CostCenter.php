<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasFactory;
    protected $table = 'cost_centers';
    protected $fillable = ['name'];

    /**
     * Get all cost centers
     *
     *
     * @return array
     */
    function getCostCenters()
    {
        return $this::select('id', 'name')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get cost center
     *
     * @param  $id
     * @return array
     */
    function getCostCenter($id)
    {
        return $this::find($id);
    }

    /**
     * Get cost centers by pluck
     *
     *
     * @return array
     */
    function getCostCentersByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }


    /**
     * Store cost center
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addCostCenter($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update cost center
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateCostCenter($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete cost center
     *
     * @param array $inputs
     * @return true
     */
    function deleteCostCenter($id)
    {
        return $this::where(array('id' => $id))->delete();
    }
}
