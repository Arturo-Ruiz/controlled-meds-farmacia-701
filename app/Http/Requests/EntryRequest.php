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
            'drugstore_id' => 'required|exists:drugstores,id', 
            'medicaments' => 'required|array|min:1',  
            'medicaments.*.medicament_id' => 'required|exists:medicaments,id',  
            'medicaments.*.stock' => 'required|integer|min:1',  
            'medicaments.*.price' => 'required|numeric|min:0'  
        ];
    }

    public function messages(): array
    {
        return [
            'invoice_number.required' => 'El número de factura es obligatorio.',
            'invoice_number.string' => 'El número de factura debe ser texto.',
            'invoice_number.max' => 'El número de factura no debe exceder 255 caracteres.',
            'drugstore_id.required' => 'La droguería es obligatoria.',
            'drugstore_id.exists' => 'La droguería seleccionada no existe.',
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
