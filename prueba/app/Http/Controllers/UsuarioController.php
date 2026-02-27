<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller{

    public function index(){
        $q = request('q');

        $usuarios = \App\Models\Usuario::query()
            ->when($q, function ($query) use ($q) {
                $query->where('codigo', 'ilike', "%{$q}%")
                    ->orWhere('nombre', 'ilike', "%{$q}%")
                    ->orWhere('correo', 'ilike', "%{$q}%");
            })
            ->orderBy('codigo', 'desc')
            ->paginate(10)
            ->appends(['q' => $q]);

        return view('usuarios.index', compact('usuarios', 'q'));
    }

    public function create(){
        return view('usuarios.create');
    }

    public function store(Request $request){
        $data = request()->validate([
            'codigo' => ['required', 'string', 'max:20'],
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:150'],
        ]);
        Usuario::create($data);

        return redirect()
            ->route('usuarios.index')
            ->with('ok', 'Usuario creado correctamente.');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->validate([
            'codigo' => ['required', 'string', 'max:50'],
            'nombre' => ['required', 'string', 'max:120'],
            'correo' => ['required', 'email', 'max:150'],
        ]);

        $usuario->update($data);

        return redirect()
            ->route('usuarios.index')
            ->with('ok', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()
            ->route('usuarios.index')
            ->with('ok', 'Usuario eliminado correctamente.');
    }

    // (Opcional) show si tu profe lo pide
    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }
}