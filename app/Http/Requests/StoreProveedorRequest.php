<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
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
            'nombreProveedor' => 'required|max:100',
            'telefonoProveedor' => 'nullable|max:15|regex:/^(\+503 ?)?[267][0-9]{3}-[0-9]{4}$/',
            'correoProveedor' => 'nullable|email'
        ];
    }

    public function messages()
    {
        return [
            'nombreProveedor.required' => 'El nombre del proveedor es obligatorio.',
            'nombreProveedor.max' => 'El nombre del proveedor no puede exceder los 100 caracteres.',
            'telefonoProveedor.regex' => 'El teléfono debe ser un número válido con formato +503 1234-5678 o similar.',
            'correoProveedor.email' => 'El correo proporcionado no es válido.',
        ];
    }
}
