<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueAttributeName;

class AttributeRequest extends FormRequest
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
            // 'name'      => ['required', 'max:100', new UniqueAttributeName ($this->name, $this-> id)]
            'name'      => 'required|max:100|unique:attribute_translations,name,' . $this->id
        ];
    }
}
