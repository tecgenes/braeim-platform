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

    public function messages(): array
    {
        return [
            'old_password.required' => __('validation.old_password_required'),
            'new_password.min' => __('validation.new_password_min'),
            'new_password.required_with' => __('validation.new_password_required_with'),
            'new_password.same' => __('validation.new_password_same'),
            'password_confirmation.required' => __('validation.password_confirmation_required'),
            'password_confirmation.min' => __('validation.password_confirmation_min'),


        ];
    }
}
