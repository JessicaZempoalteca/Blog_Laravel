@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Registrar nuevo usuario</h1>
    <p class="mb-4">Llena todos los campos obligatorios marcados con (*)</p>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" action="{{ route('registroUsuarioPost') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return validarFormulario()">
                @csrf

                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label for="nombre" class="text-gray-800">NOMBRE (S) *</label>
                        <input type="text" id="nombre" name="nombre" class="form-control form-control-user"
                            value="{{ old('nombre') }}" placeholder="EJEMPLO: JESSICA MELINA"
                            oninput="this.value = this.value.toUpperCase();">
                        @if ($errors->has('nombre'))
                            <p class="text-danger">{{ $errors->first('nombre') }}</p>
                        @endif
                    </div>

                    <div class="col-sm-4">
                        <label for="apellido_paterno" class="text-gray-800">APELLIDO PATERNO *</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control form-control-user"
                            value="{{ old('apellido_paterno') }}" placeholder="EJEMPLO: ZEMPOALTECA"
                            oninput="this.value = this.value.toUpperCase();">
                        @if ($errors->has('apellido_paterno'))
                            <p class="text-danger">{{ $errors->first('apellido_paterno') }}</p>
                        @endif
                    </div>

                    <div class="col-sm-4">
                        <label for="apellido_materno" class="text-gray-800">APELLIDO MATERNO *</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" class="form-control form-control-user"
                            value="{{ old('apellido_materno') }}" placeholder="EJEMPLO: FLORES"
                            oninput="this.value = this.value.toUpperCase();">
                        @if ($errors->has('apellido_materno'))
                            <p class="text-danger">{{ $errors->first('apellido_materno') }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="nombre_usuario" class="text-gray-800">NOMBRE DE USUARIO *</label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" id="nombre_usuario"
                            class="form-control form-control-user" value="{{ old('nombre_usuario') }}"
                            placeholder="EJEMPLO: jessm">
                        @if ($errors->has('nombre_usuario'))
                            <p class="text-danger">{{ $errors->first('nombre_usuario') }}</p>
                        @endif
                    </div>

                    <div class="col-sm-4">
                        <label for="email" class="text-gray-800">EMAIL *</label>
                        <input type="email" id="email" name="email" id="email" class="form-control form-control-user"
                            value="{{ old('email') }}" placeholder="EJEMPLO: jessm@email.com">
                        @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="col-sm-4">
                        <label for="password" class="text-gray-800">CONTRASEÑA *</label>
                        <input type="password" id="password" name="password" id="password" class="form-control form-control-user"
                            value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="rol" class="text-gray-800">ROL *</label>
                        <select name="rol" id="rol" class="form-control form-control-user">
                            <option value="">SELECCIONA UNA OPCION</option>
                            <option value="1">ADMINISTRADOR</option>
                            <option value="2">AUTOR</option>
                            <option value="3">SUSCRIPTOR</option>
                        </select>
                        @if ($errors->has('rol'))
                            <p class="text-danger">{{ $errors->first('rol') }}</p>
                        @endif
                    </div>

                    <div class="col-sm-4">
                        <label for="url_imagen" class="text-gray-800">FOTO DE PERFIL (FORMATO .png, MAXIMO 2MB) *</label>
                        <input type="file" id="url_imagen" name="url_imagen" id="url_imagen" accept="image/png">
                        @if ($errors->has('url_imagen'))
                            <p class="text-danger">{{ $errors->first('url_imagen') }}</p>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function validarFormulario() {
            let nombre = document.getElementById("nombre").value;
            let apellido_paterno = document.getElementById("apellido_paterno").value;
            let apellido_materno = document.getElementById("apellido_materno").value;
            let nombre_usuario = document.getElementById("nombre_usuario").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let url_imagen = document.getElementById("url_imagen").files.length > 0;

            if (!nombre || !apellido_paterno || !apellido_materno || 
                !nombre_usuario || !email || !password || !url_imagen) {
                alert("Todos los campos son obligatorios.");
                return false;
            }
        }
    </script>
@endsection
