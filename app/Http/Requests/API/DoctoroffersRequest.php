<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class DoctoroffersRequest extends FormRequest
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
            'details' => 'required',
            'infoAboutOffer' => 'required',
            'priceBeforDiscount' => 'required',
            'discount' => 'required',
            'doctor_id' => 'required',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'priceAfterDiscount' => $this->priceBeforDiscount - ($this->priceBeforDiscount * $this->discount / 100),
        ]);
    }
}
