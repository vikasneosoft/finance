<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = ['name', 'manager_email'];


    /**
     * Get all companies
     *
     *
     * @return array
     */
    function getCompanies()
    {
        return $this::select('id', 'name', 'manager_email')
            ->orderby('id', 'desc')
            ->get();
    }


    /**
     * Get company
     *
     * @param  $id
     * @return array
     */
    function getCompany($id)
    {
        return $this::find($id);
    }

    /**
     * Get companies by pluck
     *
     *
     * @return array
     */
    function getCompaniesByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }

    /**
     * Store company
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addCompany($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update company
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateCompany($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete company
     *
     * @param  $id
     * @return true
     */
    function deleteCompany($id)
    {
        return $this::where(array('id' => $id))->delete();
    }
}
