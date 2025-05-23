<?php

namespace App\Http\Controllers;
use App\Http\Requests\Usuario\ActualizarUsuarioRequest;
use App\Http\Requests\Usuario\RegistroUsuarioRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function __construct()
    {
        // Restricción de acceso a la sección de usuarios
        $this->middleware('auth');
        
        // Solo los usuarios con rol 1 (administrador) pueden acceder a esta sección
        $this->middleware('restrictUsuario');
    }

    public function listarUsuarios()
    {
        $usuarioLogueado = Auth::user();
        $usuarios = Usuario::select('id', 'url_imagen', 'nombre', 'apellido_paterno', 
                                    'apellido_materno', 'email', 'nombre_usuario', 'rol')
                            ->where('id', '!=', Auth::id()) // Excluir el usuario logueado
                            ->paginate(15);

        return view('usuarios.listarUsuarios', compact('usuarios', 'usuarioLogueado'));
    }

    public function registroUsuario()
    {
        $usuarioLogueado = Auth::user();
        return view('usuarios.registroUsuario', compact('usuarioLogueado'));
    }

    public function registroUsuarioPost(RegistroUsuarioRequest $request)
    {
        $imagen = $request->file('url_imagen');

        # Establecer nombre a la imagen
        $nombreImagen = Str::uuid() . '.' . $imagen->getClientOriginalExtension();

        # Redimencionar imagen
        $imagenRedimensionada = Image::make($imagen)->resize(80, 80)->encode();

        # Establecer ruta de la imagen de acuerdo al nombre de usuario
        $rutaImagen = 'usuarios/' . $nombreImagen;

        # Guardar imagen en el disco público
        Storage::disk('public')->put($rutaImagen, $imagenRedimensionada);

        $usuario = new Usuario();
        $usuario->nombre = strtoupper($request->input('nombre'));
        $usuario->apellido_paterno = strtoupper($request->input('apellido_paterno'));
        $usuario->apellido_materno = strtoupper($request->input('apellido_materno'));
        $usuario->nombre_usuario = $request->input('nombre_usuario');
        $usuario->email = $request->input('email');
        $usuario->password = bcrypt($request->input('password'));
        $usuario->rol = $request->input('rol');
        $usuario->url_imagen = $nombreImagen;
        $usuario->save();

        return redirect()->route('listarUsuarios');
    }

    public function editarUsuario($usuarios_id)
    {
        $usuarioLogueado = Auth::user();
        $usuario = Usuario::findOrFail($usuarios_id);

        return view('usuarios.editarUsuario', compact('usuarioLogueado', 'usuario'));
    }

    public function actualizarUsuario(ActualizarUsuarioRequest $request, $usuarios_id)
    {
        $usuario = Usuario::findOrFail($usuarios_id);

        # Verifica si el usuario ingresó una imagen al input
        if ($request->hasFile('url_imagen')) {
            # Busca que exista la imagen en el disco publico
            if ($usuario->url_imagen && Storage::disk('public')->exists('usuarios/' . $usuario->url_imagen)) {
                #Elimina la imagen anterior
                Storage::disk('public')->delete('usuarios/' . $usuario->url_imagen);
            }

            $imagen = $request->file('url_imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->getClientOriginalExtension();
            $imagenRedimensionada = Image::make($imagen)->resize(200, 200)->encode();
            $rutaImagen = 'usuarios/' . $nombreImagen;

            # Guarda en el disco publico la nueva imagen
            Storage::disk('public')->put($rutaImagen, $imagenRedimensionada);

            $usuario->url_imagen = $nombreImagen;
        }

        $usuario->nombre = strtoupper($request->input('nombre'));
        $usuario->apellido_paterno = strtoupper($request->input('apellido_paterno'));
        $usuario->apellido_materno = strtoupper($request->input('apellido_materno'));
        $usuario->nombre_usuario = $request->input('nombre_usuario');
        $usuario->email = $request->input('email');
        $usuario->rol = $request->input('rol');
        $usuario->estatus = $request->input('estatus');
        $usuario->save();

        return redirect()->route('listarUsuarios');
    }

    public function eliminarUsuario($usuarios_id)
    {
        $usuario = Usuario::findOrFail($usuarios_id);

        if ($usuario->url_imagen && Storage::disk('public')->exists('usuarios/' . $usuario->url_imagen)) {
            Storage::disk('public')->delete('usuarios/' . $usuario->url_imagen);
        }
        $usuario->delete();
        return redirect()->route('listarUsuarios');
    }
}
