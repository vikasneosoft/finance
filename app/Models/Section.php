<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = ['name', 'manager_email', 'department_id'];


    /**
     * Get all sections
     *
     *
     * @return array
     */
    function getSections()
    {
        return $this::with(array('department'))
            ->select('id', 'name', 'department_id', 'manager_email')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get section by department id
     *
     *
     * @return array
     */
    function getSectionByDepartmentId($departmentId)
    {
        return $this::where(array('department_id' => $departmentId))
            ->first();
    }

    /**
     * Get sections by department id
     *
     *
     * @return array
     */
    function getSectionsByDepartmentId($departmentId)
    {
        return $this::where(array('department_id' => $departmentId))
            ->get();
    }


    /**
     * Get section
     *
     * @param  $id
     * @return array
     */
    function getSection($id)
    {
        return $this::find($id);
    }

    /**
     * Get setions by pluck
     *
     *
     * @return array
     */
    function getSectionsByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }


    /**
     * Store section
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addSection($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update section
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateSection($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete section
     *
     * @param  $id
     * @return true
     */
    function deleteSection($id)
    {
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get the name of department
     */
    function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')
            ->select(array('id', 'name'));
    }
}
