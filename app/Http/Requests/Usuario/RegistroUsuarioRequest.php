<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistroUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:3|max:30|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s.-]+$/',
            'apellido_paterno' => 'required|min:3|max:30|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s.-]+$/',
            'apellido_materno' => 'required|min:3|max:30|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ\s.-]+$/',
            'nombre_usuario' => ['required', 'min:3', 'max:30', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique('usuarios', 'nombre_usuario')->ignore($this->usuario_id)],
            'email' => ['required', 'email', 'max:60', Rule::unique('usuarios', 'email')->ignore($this->usuario_id), 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => ['required', 'min:8', 'max:72', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,72}$/'],
            'rol' => 'required|integer',
            'url_imagen' => 'required|image|mimes:png|max:2048',
        ];
    }
}
