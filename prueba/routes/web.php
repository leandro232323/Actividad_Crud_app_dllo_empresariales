<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return redirect()->route('usuarios.index');
});

Route::resource('usuarios', UsuarioController::class)->parameters([
  'usuarios' => 'usuario'
]);