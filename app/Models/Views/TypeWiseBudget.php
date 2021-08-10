<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeWiseBudget extends Model
{
    use HasFactory;
    protected $table = 'view_type_wise_budgets';

    function getData($company_id, $location_id, $division_id, $department_id, $section_id)
    {

        return $this::where(array('company_id' => $company_id))
            ->when($division_id, function ($query, $division_id) {
                return $query->where('division_id', $division_id);
            })
            ->when($department_id, function ($query, $department_id) {
                return $query->where('department_id', $department_id);
            })
            ->when($section_id, function ($query, $section_id) {
                return $query->where('section_id', $section_id);
            })
            ->select('year', 'type', 'cat_name', 'budget_amount', 'expense_amount')
            //->orderBy('cat_name','DESC')
            ->get();
    }
}
