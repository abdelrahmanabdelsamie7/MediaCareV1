<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentuserRequest extends FormRequest
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
            'department_id' => 'required',
            'user_id' => 'required',
            // 'doctor_id' => 'required',
            'message' => 'required',
            'repaly' => '',
            // 'date' => 'required',
        ];
    }
}
