<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $doctorId = $this->route('id');
        return [
            'first_name' => 'required|string|between:2,100',
            'second_name' => 'required|string|between:2,100',
            'third_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'title' => 'required',
            'image' => 'required',
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|string|email|max:100|unique:doctors,email,' . $doctorId,
            'gender' => 'required',
            'phone' => 'required',
            'detectionPrice' => 'required',
            'infoDoctor' => 'required',
            'birth_date' => 'required',
            'homeOption' => 'required',
            'department_id' => 'required',
            'userType'
        ];
    }
}
