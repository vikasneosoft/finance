<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
                'name'    => 'required|max:100|unique:sections,name,' . $this->request->get("id") . ',id',
                'manager_email'    => 'required|email|unique:sections,manager_email,' . $this->request->get("id") . ',id',
                'department_id'    => 'required',
            );
        } else {
            $valid = array(
                'name'    => 'required|max:100|unique:sections,name,NULL,id',
                'manager_email'    => 'required|email|unique:sections,manager_email,NULL,id',
                'department_id'    => 'required',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Name is required',
            'name.unique'       => 'Name already exists',
            'name.max'          => 'Max length should be 100 characters',
            'department_id.required'     => 'Select department',
            'manager_email.required'     => 'Manager email is required.',
            'manager_email.unique'     => 'Email id already exists',
        ];
    }
}
