<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugstoreRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:drugstores,name,' . ($this->drugstore->id ?? 'NULL'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la droguería es obligatorio.',
            'name.string' => 'El nombre de la droguería debe ser una cadena de texto.',
            'name.max' => 'El nombre de la droguería no debe exceder los 255 caracteres.',
            'name.unique' => 'Ya existe una droguería con este nombre.',  
        ];
    }
}
