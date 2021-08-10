<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rounting extends Model
{
    use HasFactory;
    protected $table = 'rountings';
    protected $fillable = ['employee_id', 'manager_id', 'level', 'maximum_amount'];

    /**
     * Get all Rountings
     *
     *
     * @return array
     */
    function getRountings()
    {
        return $this::with(array('manager', 'employee'))
            ->select('id', 'employee_id', 'manager_id', 'level', 'maximum_amount')
            ->orderby('id', 'desc')
            ->get();
    }


    /**
     * Get Routing
     *
     * @param  $id
     * @return array
     */
    function getRounting($id)
    {
        return $this::find($id);
    }

     /**
     * Get all Rountings
     *
     *
     * @return array
     */
    function getRountingByEmployeeId($employeeId)
    {
        return $this::with(array('manager'))
            ->select('manager_id', 'level', 'maximum_amount')
            ->where(array('employee_id'=>$employeeId))
            ->orderby('level', 'asc')
            ->get();
    }

    /**
     * Store Rounting
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addRounting($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Rounting
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateRounting($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Rounting
     *
     * @param array $inputs
     * @return true
     */
    function deleteRounting($id)
    {
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get the name of manager.
     */
    function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of employee.
     */
    function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id')
            ->select(array('id', 'name'));
    }
}
