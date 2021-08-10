<?php

namespace App\Http\Requests\Employee;

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
                'budget_code'      => 'required|max:255|unique:budgets,budget_code,' . $this->request->get("id") . ',id',
                'budget_type_id'        => 'required|',
                'financial_year'    => 'required|',
                'cost_center_id' => 'required|',
                'project_code_id'            => 'required|',
                'project_in_charge'       => 'required|',
                'budget_proj_ref_no'           => 'required|',
                'vendor'         => 'required|',
                'vendor_contacts'    => 'required|',
                'budget_from_date'    => 'required|',
                'budget_to_date'    => 'required|',
            );
        } else {
            $valid = array(
                'budget_code'       => 'required|max:255|unique:budgets,budget_code,NULL,id',
                'budget_type_id'        => 'required|',
                'financial_year'    => 'required|',
                'cost_center_id' => 'required|',
                'project_code_id'            => 'required|',
                'project_in_charge'       => 'required|',
                'budget_proj_ref_no'           => 'required|',
                'vendor'    => 'required|',
                'vendor_contacts'    => 'required|',
                'budget_from_date'                 => 'required|',
                'budget_to_date'    => 'required|',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'budget_type_id.required'           => 'Select budget type',
            'budget_category_id.required'       => 'Select budget category',
            'budget_subcategory_id.required'    => 'Select budget subcategory',
            'budget_for.required'               => 'Budget for field is required',
            'budget_quantity.required'          => 'Quantity is required',
            'budget_rate.required'              => 'Rate is required',
            'budget_amount.required'            => 'Amount is required',

            'budget_from_date.required'         => 'Select budget from date',
            'budget_to_date.required'           => 'Select budget to date',
            'budget_vendor.required'            => 'Budget vendor is requird',
            'budget_proj_ref_no.required'       => 'Budget proj ref field is required',
            'specifications.required'           => 'Specification field is required',


        ];
    }
}
