<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $table = 'divisions';
    protected $fillable = ['name', 'manager_email', 'company_id'];

    /**
     * Get all divisions
     *
     *
     * @return array
     */
    function getDivisions()
    {
        return $this::with(array('company'))
            ->select('id', 'name', 'company_id', 'manager_email')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get division by company id
     *
     *
     * @return array
     */
    function getDivisionByCompnayId($companId)
    {
        return $this::where(array('company_id' => $companId))
            ->first();
    }

    /**
     * Get divisions by company id
     *
     *
     * @return array
     */
    function getDivisionsByCompnayId($companId)
    {
        return $this::where(array('company_id' => $companId))
            ->get();
    }


    /**
     * Get division
     *
     * @param  $id
     * @return array
     */
    function getDivision($id)
    {
        return $this::find($id);
    }

    /**
     * Get divisions by pluck
     *
     *
     * @return array
     */
    function getDivisionsByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }


    /**
     * Store Division
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addDivision($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Division
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateDivision($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Division
     *
     * @param array $inputs
     * @return true
     */
    function deleteDivision($id)
    {
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get the name of company.
     */
    function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')
            ->select(array('id', 'name'));
    }
}
