<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'nombre_usuario',
        'email',
        'password',
        'rol',
        'estatus',
        'url_imagen'
    ];
}
