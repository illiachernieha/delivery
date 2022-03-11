<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'orderDetails' => 'required',
            'orderDetails.expectedTime' => 'required|string',
            'orderDetails.deliveryAddress' => 'required|string|min:10',
            'orderDetails.billingAddress' => 'present',
            'customerId' => 'required|integer|min:1',
            'orderItems' => 'required',
            'orderItems.itemId' => 'required|integer',
            'orderItems.itemQuantity' => 'required|integer|min:1'
        ];
    }
}
