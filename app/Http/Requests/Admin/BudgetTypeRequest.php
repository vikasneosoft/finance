<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BudgetTypeRequest extends FormRequest
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
                'name'      => 'required|max:200|unique:budget_types,name,' . $this->request->get("id") . ',id',

            );
        } else {
            $valid = array(
                'name'       => 'required|max:200|unique:budget_types,name,NULL,id',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Budget type is required.',
            'name.unique'       => 'Budget type already exists.',
            'name.max'          => 'Max length should be 200 characters',
        ];
    }
}
