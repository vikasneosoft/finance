<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = ['name', 'manager_email', 'division_id'];


    /**
     * Get all departments
     *
     *
     * @return array
     */
    function getDepartments()
    {
        return $this::with(array('division'))
            ->select('id', 'name', 'division_id', 'manager_email')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get department by division id
     *
     *
     * @return array
     */
    function getDepartmentByDivisionId($divisionId)
    {
        return $this::where(array('division_id' => $divisionId))
            ->first();
    }

    /**
     * Get departments by division id
     *
     *
     * @return array
     */
    function getDepartmentsByDivisionId($divisionId)
    {
        return $this::where(array('division_id' => $divisionId))
            ->get();
    }


    /**
     * Get department
     *
     * @param  $id
     * @return array
     */
    function getDepartment($id)
    {
        return $this::find($id);
    }

    /**
     * Get departments by pluck
     *
     *
     * @return array
     */
    function getDepartmentsByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }


    /**
     * Store department
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addDepartment($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update department
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateDepartment($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete department
     *
     * @param  $id
     * @return true
     */
    function deleteDepartment($id)
    {
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get the name of division
     */
    function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id')
            ->select(array('id', 'name'));
    }
}
