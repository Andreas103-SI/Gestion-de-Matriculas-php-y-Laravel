<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permitir a todos los usuarios (cambiar con roles más tarde)
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni_nie' => 'required|string|max:20|unique:students,dni_nie,' . ($this->student ? $this->student->id : 'NULL'),
            'email' => 'required|email|max:255|unique:students,email,' . ($this->student ? $this->student->id : 'NULL'),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'required|date|before:today',
            'disability' => 'nullable|boolean',
        ];
    }
}