<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    use HasFactory;
    protected $table = 'financial_years';
    protected $fillable = ['year'];

    /**
     * Get all financial years
     *
     *
     * @return array
     */
    function getFinancialYears()
    {
        return $this::select('id', 'year')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get financial year
     *
     * @param  $id
     * @return array
     */
    function getFinancialYear($id)
    {
        return $this::find($id);
    }

    /**
     * Get financial years by pluck
     *
     *
     * @return array
     */
    function getFinancialYearsByPluck()
    {
        return $this::orderby('year', 'asc')
            ->pluck('year', 'id');
    }


    /**
     * Store financial year
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addFinancialYear($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update financial year
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateFinancialYear($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete financial year
     *
     * @param array $inputs
     * @return true
     */
    function deleteFinancialYear($id)
    {
        return $this::where(array('id' => $id))->delete();
    }
}
