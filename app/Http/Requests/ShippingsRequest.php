<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //
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
            'id' => 'exists:settings',
            'plain_value' => 'required|nullable|numeric',
            'value' => 'required',
        ];
    }

    public function messages() {
        return [
            'id.exists' => 'لا توجد سجلات لهذا الرقم',
            'plain_value.numeric' => 'صيغة البريد الإلكتروني غير صحيحة',
            'value.required' => 'يجب إدخال القيمة',
        ];
    }
}
