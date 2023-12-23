<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProfileChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required',
            'new_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'old_password.required' => 'Please enter Old Password',
//            'new_password.min' => 'Password leanth is 6',
//            'new_password.required_with' => 'Please enter confirmation',
//            'new_password.same' => 'Password and confirmation must be same',
//            'password_confirmation.required' => 'Please enter password confirmation'
//
//
//        ];
//    }
}
