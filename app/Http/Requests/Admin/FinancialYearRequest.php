<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FinancialYearRequest extends FormRequest
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
                'year'      => 'required|max:7|unique:financial_years,year,' . $this->request->get("id") . ',id',

            );
        } else {
            $valid = array(
                'year'       => 'required|max:7|unique:financial_years,year,NULL,id',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'year.required'     => 'Enter financial year',
            'year.unique'       => 'Financial year already exists.',
        ];
    }
}
