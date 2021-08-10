<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
                'name'      => 'required|max:200|unique:companies,name,' . $this->request->get("id") . ',id',
                'manager_email' => 'required|email|unique:companies,manager_email,' . $this->request->get("id") . ',id',

            );
        } else {
            $valid = array(
                'name'       => 'required|max:200|unique:companies,name,NULL,id',
                'manager_email'       => 'required|email|unique:companies,manager_email,NULL,id',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Company name is required.',
            'name.unique'       => 'Company name already exists.',
            'name.max'          => 'Max length should be 200 characters',
            'manager_email.required'     => 'Manager email is required.',
            'manager_email.unique'     => 'Email id already exists',
        ];
    }
}
