<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaRequest extends FormRequest
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
            'fechaFactura' => 'required',
            'facturador' => 'required|min:5|max:100',
            'totalFactura' => 'required|numeric|min:0.01',
            'idProveedor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fechaFactura.required' => 'La fecha de la factura es obligatoria.',
            'facturador.min' => 'El nombre del facturador es obligatorio y no puede exceder los 100 caracteres.',
            'totalFactura.min' => 'Ingrese un valor valido.',
            'idProveedor.required' => 'Seleccione un proveedor.',
        ];
    }
}
