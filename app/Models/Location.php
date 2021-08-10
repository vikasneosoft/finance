<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = ['name', 'manager_email', 'company_id'];

    /**
     * Get all locations
     *
     *
     * @return array
     */
    function getLocations()
    {
        return $this::with(array('company'))
            ->select('id', 'name', 'company_id', 'manager_email')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get location by company id
     *
     *
     * @return array
     */
    function getLocationByCompnayId($companId)
    {
        return $this::where(array('company_id' => $companId))
            ->first();
    }

    /**
     * Get locations by company id
     *
     *
     * @return array
     */
    function getLocationsByCompnayId($companId)
    {
        return $this::where(array('company_id' => $companId))
            ->get();
    }


    /**
     * Get location
     *
     * @param  $id
     * @return array
     */
    function getLocation($id)
    {
        return $this::find($id);
    }

    /**
     * Get location by pluck
     *
     *
     * @return array
     */
    function getLocationsByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }



    /**
     * Store location
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addLocation($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update location
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateLocation($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete location
     *
     * @param array $inputs
     * @return true
     */
    function deleteLocation($id)
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
