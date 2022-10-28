<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$this->id,
            'password' => 'nullable|required_with:password_confirmation|confirmed|min:8',
            'password_confirmation' => 'nullable|required_with:password'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'فضلا أدخل اسم المستخدم',
            'email.required' => 'فضلا أدخل البريد الإلكتروني',
            // 'email.email' => 'البريد الإلكتروني المدخل غير صحيح',
            'email.unique' => 'يوجد حساب آخر بهذا البريد الإلكتروني',
            'password.min' => 'كلمة المرور يجب أن تتكون من 8 خانات على الأقل',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين',
            'password.required_with' => 'فضلا أدخل كلمة المرور',
            'password_confirmation.required_with' => 'فضلا قم بتأكيد كلمة المرور',
        ];
    }
}
