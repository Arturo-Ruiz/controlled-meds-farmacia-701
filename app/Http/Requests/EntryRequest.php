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
            'id_laboratory' => 'required|exists:laboratories,id',
            'id_medicament' => 'required|exists:medicaments,id',
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
            'id_laboratory.required' => 'El laboratorio es obligatorio.',
            'id_laboratory.exists' => 'El laboratorio seleccionado no existe.',
            'id_medicament.required' => 'El medicamento es obligatorio.',
            'id_medicament.exists' => 'El medicamento seleccionado no existe.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor a 0.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio debe ser mayor o igual a 0.'
        ];
    }
}
