<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'presentation' => 'required|string|max:255',
            'posological_units' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'expiration_date' => 'required|date|after:today',
            'laboratory_id' => 'nullable|exists:laboratories,id',
            'medicament_type_id' => 'nullable|exists:medicament_types,id',
            'active_ingredient_id' => 'nullable|exists:active_ingredients,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',

            'presentation.required' => 'La presentación es obligatoria.',
            'presentation.string' => 'La presentación debe ser una cadena de texto.',
            'presentation.max' => 'La presentación no debe exceder los 255 caracteres.',

            'posological_units.required' => 'Las unidades posológicas son obligatorias.',
            'posological_units.integer' => 'Las unidades posológicas deben ser un número entero.',
            'posological_units.min' => 'Las unidades posológicas deben ser al menos 1.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',

            'min_stock.required' => 'El stock mínimo es obligatorio.',
            'min_stock.integer' => 'El stock mínimo debe ser un número entero.',
            'min_stock.min' => 'El stock mínimo no puede ser negativo.',

            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',

            'expiration_date.required' => 'La fecha de expiración es obligatoria.',
            'expiration_date.date' => 'La fecha de expiración debe ser una fecha válida.',
            'expiration_date.after' => 'La fecha de expiración debe ser una fecha futura.',

            'laboratory_id.exists' => 'El laboratorio seleccionado no existe.',
            'medicament_type_id.exists' => 'El tipo de medicamento seleccionado no existe.',
            'active_ingredient_id.exists' => 'El principio activo seleccionado no existe.',
        ];
    }
}
