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
            'medicament_id' => 'required|exists:medicaments,id',
            'amount' => 'required|integer|min:1',
            'reason' => 'required|in:Venta,Medicamento Vencido,Error de Inventario'
        ];
    }

    public function messages(): array
    {
        return [
            'medicament_id.required' => 'El medicamento es obligatorio.',
            'medicament_id.exists' => 'El medicamento seleccionado no existe.',
            'amount.required' => 'La cantidad es obligatoria.',
            'amount.integer' => 'La cantidad debe ser un número entero.',
            'amount.min' => 'La cantidad debe ser mayor a 0.',
            'reason.required' => 'La razón es obligatoria.',
            'reason.in' => 'La razón debe ser una de las opciones válidas.'
        ];
    }
}
