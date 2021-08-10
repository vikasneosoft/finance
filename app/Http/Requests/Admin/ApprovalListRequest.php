<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ApprovalListRequest extends FormRequest
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
                'employe_id'        => 'required|',
                'level_one_id'      => 'required',
                'level_one_max'     => 'required|',
                'level_two_id'      => 'required|',
                'level_two_max'     => 'required|',
                'level_three_id'    => 'required|',
                'level_three_max'   => 'required|',
                'level_four_id'     => 'required|',
                'level_four_max'    => 'required|',
                'level_five_id'     => 'required|',
                'level_five_max'    => 'required|',
            );
        } else {
            $valid = array(
                'employe_id'        => 'required|',
                'level_one_id'      => 'required|',
                'level_one_max'     => 'required|',
                'level_two_id'      => 'required|',
                'level_two_max'     => 'required|',
                'level_three_id'    => 'required|',
                'level_three_max'   => 'required|',
                'level_four_id'     => 'required|',
                'level_four_max'    => 'required|',
                'level_five_id'     => 'required|',
                'level_five_max'    => 'required|',
            );
        }
        return $valid;
    }

    public function messages()
    {
        return [
            'employe_id.required'       => 'Select employe',
            'level_one_id.required'     => 'Level one field is required',
            'level_one_id.email'        => 'Email is not valid',
            'level_one_max.required'    => 'Level one max field is required',
            'level_two_id.required'     => 'Level two field is required',
            'level_two_id.email'        => 'Email is not valid',
            'level_two_max.required'    => 'Level two max field is required',
            'level_three_id.required'   => 'Level three field is required',
            'level_three_id.email'      => 'Email is not valid',
            'level_three_max.required'  => 'Level three max field is required',
            'level_four_id.required'    => 'Level four field is required',
            'level_four_id.email'       => 'Email is not valid',
            'level_four_max.required'   => 'Level four max field is required',
            'level_five_id.required'    => 'Level five field is required',
            'level_five_id.email'       => 'Email is not valid',
            'level_five_max.required'   => 'Level five max field is required',
        ];
    }
}
