<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required|string|in:DELIVERY,IN-DINE,TAKEAWAY',

            'customer_number' => 'required_if:type,DELIVERY|nullable|string',
            'customer_name' => 'required_if:type,DELIVERY|nullable|string',
            'delivery_fees' => 'required_if:type,DELIVERY|nullable|numeric',

            'table_number' => 'required_if:type,IN-DINE|nullable|integer',
            'service_charge' => 'required_if:type,IN-DINE|nullable|numeric',
            'waiter_name' => 'required_if:type,IN-DINE|nullable|string',

            'items' => 'required|array',
            'items.*.item_quantity' => 'required|integer',
            'items.*.item_price' => 'required|numeric',
            'items.*.item_name' => 'required|string',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'errors' => $validator->messages()->all(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
