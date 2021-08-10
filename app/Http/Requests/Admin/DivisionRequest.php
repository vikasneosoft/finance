<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DivisionRequest extends FormRequest
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
                'name'    => 'required|max:150|unique:divisions,name,' . $this->request->get("id") . ',id',
                'manager_email'    => 'required|email|unique:divisions,manager_email,' . $this->request->get("id") . ',id',
                'company_id'    => 'required',
            );
        } else {
            $valid = array(
                'name'    => 'required|max:150|unique:divisions,name,NULL,id',
                'manager_email'    => 'required|email|unique:divisions,manager_email,NULL,id',
                'company_id'    => 'required',
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
            'company_id.required'     => 'Select company',
            'manager_email.required'     => 'Manager email is required.',
            'manager_email.unique'     => 'Email id already exists',
        ];
    }
}
