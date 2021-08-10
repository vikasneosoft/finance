<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCodeRequest extends FormRequest
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
                'code'    => 'required|max:255|unique:project_codes,code,' . $this->request->get("id") . ',id',
            );
        } else {
            $valid = array(
                'code'    => 'required|max:255|unique:project_codes,code,NULL,id',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'code.required'     => 'Code is required',
            'code.unique'       => 'Code already exists',
        ];
    }
}
