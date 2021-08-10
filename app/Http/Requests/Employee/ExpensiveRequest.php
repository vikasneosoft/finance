<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class ExpensiveRequest extends FormRequest
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
                'expensive_code'      => 'required|max:255|',
                'budget_type_id'        => 'required|',
                'financial_year'    => 'required|',
                'cost_center_id' => 'required|',
                'project_code_id'            => 'required|',
                'project_in_charge'       => 'required|',
                'proj_ref_no'           => 'required|',
                'vendor'         => 'required|',
                'vendor_contacts'    => 'required|',
                'from_date'    => 'required|',
                'to_date'    => 'required|',
                'reason_for_selecting_vendor'    => 'required|',
                'assumptions_or_inclusions'    => 'required|',
                'exceptions_or_exclusions'    => 'required|',
                'payment_terms'    => 'required|',
                'warranty_guarantee_details'    => 'required|',
            );
        } else {
            $valid = array(
                'expensive_code'       => 'required|max:255|',
                'budget_type_id'        => 'required|',
                'financial_year'    => 'required|',
                'cost_center_id' => 'required|',
                'project_code_id'            => 'required|',
                'project_in_charge'       => 'required|',
                'proj_ref_no'           => 'required|',
                'vendor'    => 'required|',
                'vendor_contacts'    => 'required|',
                'from_date'                 => 'required|',
                'to_date'    => 'required|',
                'reason_for_selecting_vendor'    => 'required|',
                'assumptions_or_inclusions'    => 'required|',
                'exceptions_or_exclusions'    => 'required|',
                'payment_terms'    => 'required|',
                'warranty_guarantee_details'    => 'required|',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'expensive_code.required'         => 'Expensive Code is required',
            'expensive_code.unique'           => 'Expensive Code already exists',
            'budget_type_id.required'         => 'Select budget type',
            'from_date.required'              => 'Select from date',
            'to_date.required'                => 'Select to date',
            'vendor.required'                 => 'Budget vendor is requird',
            'proj_ref_no.required'            => 'Project ref no is required',
            'reason_for_selecting_vendor.required'       => 'Reason is required',
            'assumptions_or_inclusions.required'       => 'Assumption or inclusion is required',
            'exceptions_or_exclusions.required'       => 'Exceptions or exclusions is required',
            'payment_terms.required'            => 'Payment term is required',
            'warranty_guarantee_details.required'       => 'Warranty guarantee detail is required',
        ];
    }
}
