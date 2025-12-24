<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MidtransCallbackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_id' => 'required',
            'status_code' => 'required',
            'gross_amount' => 'required',
            'signature_key' => 'required',
            'transaction_status' => 'required',
        ];
    }
}
