<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispatchRequest extends FormRequest
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
            'reason' => 'required|string|in:Venta,Medicamento Vencido,Error de Inventario',
            'medicaments' => 'required|array|min:1',
            'medicaments.*.medicament_id' => 'required|exists:medicaments,id',
            'medicaments.*.amount' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'reason.required' => 'La razón de la salida es obligatoria.',
            'reason.in' => 'La razón seleccionada no es válida.',
            'medicaments.required' => 'Debe agregar al menos un medicamento.',
            'medicaments.min' => 'Debe agregar al menos un medicamento.',
            'medicaments.*.medicament_id.required' => 'El medicamento es obligatorio.',
            'medicaments.*.medicament_id.exists' => 'El medicamento seleccionado no existe.',
            'medicaments.*.amount.required' => 'La cantidad es obligatoria.',
            'medicaments.*.amount.integer' => 'La cantidad debe ser un número entero.',
            'medicaments.*.amount.min' => 'La cantidad debe ser mayor a 0.',
        ];
    }
}
