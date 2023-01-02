<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranSaleRequest extends FormRequest
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
           'no_transaction' => 'required',
           'grand_total' => 'required',
           'bayar' => 'required',
            'kembali' => 'required'
        ];
    }
}
