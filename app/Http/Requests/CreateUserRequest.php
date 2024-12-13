<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        return [
            'name' => 'required|min:3|regex:/[a-zA-Z]/',
            'email' => 'unique:users',
            'password' => 'required',
            'role' => 'required',
            'is_active' => 'required',
            'state_id' => 'nullable',
            'district_id' => 'nullable',
            'mobile_no' => 'nullable|string',
            'office' => 'nullable|string',
        ];
    }
}
