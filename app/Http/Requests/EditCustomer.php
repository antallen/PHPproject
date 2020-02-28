<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCustomer extends FormRequest
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
            'Cusid'=>'required|string',
            'Name'=>'required|string',
            'Address'=>'required|string',
            'Phone' => 'required|string'
        ];
    }

    //自訂錯誤訊息
    public function messages(){
        return [
        'required' => '不可為空白',
        'string' => '必須為字串'
        ];
    }
}
