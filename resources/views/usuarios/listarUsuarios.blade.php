@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
    <a href="{{ route('registroUsuario') }}" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Registrar usuario</span>
    </a>
    <br><br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Nombre de usuario</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Nombre de usuario</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td><center><img src="{{ asset('storage/usuarios/' . $usuario->url_imagen) }}" width="60px" height="60px"></center></td>
                                <td>{{ $usuario->nombre }} {{ $usuario->apellido_paterno }}
                                    {{ $usuario->apellido_materno }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->nombre_usuario }}</td>
                                <td>
                                    @if ($usuario->rol == 1)
                                        Administrador
                                    @elseif ($usuario->rol == 2)
                                        Autor
                                    @elseif ($usuario->rol == 3)
                                        Suscriptor
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('editarUsuario', $usuario->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('eliminarUsuario', $usuario->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $usuarios->links() }}
        </div>
    </div>

@endsection
