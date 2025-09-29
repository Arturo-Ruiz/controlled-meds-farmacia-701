<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
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
            'invoice_number' => 'required|string|max:255',
            'laboratory_id' => 'required|exists:laboratories,id',
            'medicament_id' => 'required|exists:medicaments,id',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'invoice_number.required' => 'El número de factura es obligatorio.',
            'invoice_number.string' => 'El número de factura debe ser texto.',
            'invoice_number.max' => 'El número de factura no debe exceder 255 caracteres.',
            'laboratory_id.required' => 'El laboratorio es obligatorio.',
            'laboratory_id.exists' => 'El laboratorio seleccionado no existe.',
            'medicament_id.required' => 'El medicamento es obligatorio.',
            'medicament_id.exists' => 'El medicamento seleccionado no existe.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor a 0.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio debe ser mayor o igual a 0.'
        ];
    }
}
