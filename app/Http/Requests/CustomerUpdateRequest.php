<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(Customer::class)->ignore($this->id)],
            'gender' => ['required', Rule::in(['Masculino', 'Feminino'])],
            'birthdate' => ['required'],
        ];
    }
}
