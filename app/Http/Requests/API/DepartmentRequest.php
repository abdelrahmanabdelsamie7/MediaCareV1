<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    
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
            'title' => 'required|string',
            'infoAboutDepartment' => 'required|string',
            'image' => 'required'
        ];
    }
}
