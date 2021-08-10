<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CostCenterRequest extends FormRequest
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
                'name'      => 'required|max:255|unique:cost_centers,name,' . $this->request->get("id") . ',id',

            );
        } else {
            $valid = array(
                'name'       => 'required|max:255|unique:cost_centers,name,NULL,id',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Cost center name is required.',
            'name.unique'       => 'Cost center name already exists.',
        ];
    }
}
