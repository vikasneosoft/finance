<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployRequest extends FormRequest
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
                'name'          => 'required|max:255|',
                'email'         => 'required|email|unique:users,email,' . $this->request->get("id") . ',id',
                'company_id'            => 'required|',
                // 'division_id'            => 'required|',
                // 'location_id'            => 'required|',
                //'department_id'            => 'required|',
                //'section_id'    => 'required|',
            );
        } else {
            $valid = array(
                'name'                  => 'required|max:255|',
                'email'                 => 'required|email|unique:users,email,NULL,id',
                'company_id'            => 'required|',
                // 'division_id'            => 'required|',
                // 'location_id'            => 'required|',
                //'department_id'            => 'required|',
                // 'section_id'            => 'required|',
                'password'              => 'required|',
                'confirmed_password'    => 'required|same:password',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'name.required'             => 'Company name is required',
            'email.required'            => 'Email id is required',
            'email.unique'              => 'Email id already exists',
            'company_id.required'       => 'Select company',
            'division_id.required'       => 'Select division',
            'location_id.required'       => 'Select location',
            'department_id.required'       => 'Select department',
            'section_id.required'       => 'Select section',
            'password'                  => 'Please enter password',
            'confirmed_password'        => 'Please enter confirmed Password',
            'confirmed_password.same'   => 'New password and confirm password do not match.Please enter both again',
        ];
    }
}
