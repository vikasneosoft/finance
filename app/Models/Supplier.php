<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = ['name', 'email', 'contact_person', 'mobile_number', 'address'];


    /**
     * Get all suppliers
     *
     *
     * @return array
     */
    function getSuppliers()
    {
        return $this::select('id', 'name', 'email', 'contact_person', 'mobile_number', 'address')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get Supplier
     *
     * @param  $id
     * @return array
     */
    function getSupplier($id)
    {
        return $this::find($id);
    }


    /**
     * Store Supplier
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addSupplier($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Supplier
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateSupplier($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Supplier
     *
     * @param  $id
     * @return true
     */
    function deleteSupplier($id)
    {
        return $this::where(array('id' => $id))->delete();
    }
}
