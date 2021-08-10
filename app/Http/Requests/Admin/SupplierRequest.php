<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
                'name'      => 'required|max:255',
                'email' => 'required|email|unique:suppliers,email,' . $this->request->get("id") . ',id',
                'contact_person'      => 'required|',
                'mobile_number'      => 'required|',
                'address'      => 'required|',

            );
        } else {
            $valid = array(
                'name'       => 'required|max:255',
                'email'       => 'required|email|unique:suppliers,email,NULL,id',
                'contact_person'      => 'required|',
                'mobile_number'      => 'required|',
                'address'      => 'required|',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Company name is required.',
            'contact_person.required'     => 'Contact person is required.',
            'mobile_number.required'     => 'Mobile number is required.',
            'email.required'     => 'Email is required.',
            'email.unique'     => 'Email id already exists',
        ];
    }
}
