<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCode extends Model
{
    use HasFactory;
    protected $table = 'project_codes';
    protected $fillable = ['code'];

    /**
     * Get all project codes
     *
     *
     * @return array
     */
    function getProjectCodes()
    {
        return $this::select('id', 'code')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get project code
     *
     * @param  $id
     * @return array
     */
    function getProjectCode($id)
    {
        return $this::find($id);
    }

    /**
     * Get project codes by pluck
     *
     *
     * @return array
     */
    function getProjectCodesByPluck()
    {
        return $this::orderby('code', 'asc')
            ->pluck('code', 'id');
    }


    /**
     * Store project code
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addProjectCode($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update  project code
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateProjectCode($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete project code
     *
     * @param array $inputs
     * @return true
     */
    function deleteProjectCode($id)
    {
        return $this::where(array('id' => $id))->delete();
    }
}
