<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->request->get('action') == 'edit') {
            $valid = array(
                'financial_year'        => 'required|max:10|',
                'company_id'            => 'required|',
                'location_id'           => 'required|',
                'division_id'           => 'required|',
                'department_id'         => 'required|',
                'section_id'            => 'required|',
                'budget_type_id'        => 'required|',
                'budget_category_id'    => 'required|',
                'budget_subcategory_id' => 'required|',
                'budget_for'            => 'required|',
                'budget_quantity'       => 'required|',
                'budget_rate'           => 'required|',
                'budget_amount'         => 'required|',

                'budget_from_date'      => 'required|',
                'budget_to_date'        => 'required|',
                'budget_vendor'         => 'required|',
                'budget_proj_ref_no'    => 'required|',

            );
        } else {
            $valid = array(
                'financial_year'        => 'required|max:10|',
                'company_id'            => 'required|',
                'location_id'           => 'required|',
                'division_id'           => 'required|',
                'department_id'         => 'required|',
                'section_id'            => 'required|',
                'budget_type_id'        => 'required|',
                'budget_category_id'    => 'required|',
                'budget_subcategory_id' => 'required|',
                'budget_for'            => 'required|',
                'budget_quantity'       => 'required|',
                'budget_rate'           => 'required|',
                'budget_amount'         => 'required|',

                'budget_from_date'      => 'required|',
                'budget_to_date'        => 'required|',
                'budget_vendor'         => 'required|',
                'budget_proj_ref_no'    => 'required|',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'financial_year.required'           => 'Financial year is required',
            'company_id.required'               => 'Select company',
            'location_id.required'              => 'Select location',
            'division_id.required'              => 'Select division',
            'department_id.required'            => 'Select department',
            'section_id.required'               => 'Select section',
            'budget_type_id.required'           => 'Select budget type',
            'budget_category_id.required'       => 'Select budget category',
            'budget_subcategory_id.required'    => 'Select budget subcategory',
            'budget_for.required'               => 'Budget for field is required',
            'budget_quantity.required'          => 'Quantity is required',
            'budget_rate.required'              => 'Rate is required',
            'budget_amount.required'            => 'Amount is required',

            'budget_from_date.required'         => 'Select start from date',
            'budget_to_date.required'           => 'Select budget to date',
            'budget_vendor.required'            => 'Budget vendor is requird',
            'budget_proj_ref_no.required'       => 'Budget proj ref field is required',
        ];
    }
}
