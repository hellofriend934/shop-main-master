<?php

namespace App\Http\Requests;

use Domain\Order\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class OrderFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer.first_name'=>['required'],
            'customer.last_name'=>['required'],
            'customer.email'=>['required'],
            'customer.phone'=>['required'],
            'customer.city'=>['sometimes'],
            'customer.address'=>['sometimes'],
            'delivery_type_id'=>['required','exists:delivery_types,id'],
            'payment_method_id'=>['required','exists:payment_methods,id'],

        ];
    }
}
