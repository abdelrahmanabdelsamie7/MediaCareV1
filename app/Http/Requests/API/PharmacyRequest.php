<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'infoAboutPharmacy' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'locationUrl' => 'required',
            'whatsappLink' => 'required',
            'image' => 'required',
            'optionDelivery' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ];
    }
}
