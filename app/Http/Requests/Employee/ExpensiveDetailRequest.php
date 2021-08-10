<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class ExpensiveDetailRequest extends FormRequest
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

                'expensive_for'            => 'required|',
                'budget_category_id'    => 'required|',
                'budget_subcategory_id' => 'required|',
                'expensive_quantity'       => 'required|',
                'expensive_rate'           => 'required|',
                'specifications'    => 'required|',
            );
        } else {
            $valid = array(
                'expensive_for'            => 'required|',
                'budget_category_id'    => 'required|',
                'budget_subcategory_id' => 'required|',
                'expensive_quantity'       => 'required|',
                'expensive_rate'           => 'required|',
                'specifications'    => 'required|',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'expensive_for.required'               => 'Expense for field is required',
            'budget_category_id.required'       => 'Select budget category',
            'budget_subcategory_id.required'    => 'Select budget subcategory',
            'expensive_quantity.required'          => 'Quantity is required',
            'expensive_rate.required'              => 'Rate is required',
            'specifications.required'           => 'Specification field is required',
        ];
    }
}
