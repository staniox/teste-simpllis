<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'brand_id' => ['required', Rule::exists(Brand::class)],
            'customer_id' => ['required', Rule::exists(Customer::class)],
        ];
    }
}
