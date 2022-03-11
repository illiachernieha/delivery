<?php

namespace App\Http\Requests;

use Delivery\Order\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => ['required', Rule::in([Status::NEW->name, Status::APPROVED->name])]
        ];
    }
}
