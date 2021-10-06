<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateCompany extends FormRequest
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
        $id = $this->segment(2);

        $rules = [
            'name' => [
                "required",
                "min:3",
                "max:255",
                Rule::unique('companies')->ignore($id),
            ],
            'image' => "required|image",
        ];
        
        if($this->method() == 'PUT')
            $rules['image'] = ['nullable','image'];

        return $rules;
    }
}
