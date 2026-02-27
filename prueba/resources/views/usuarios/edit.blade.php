<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Editar usuario</title>
  <style>
    body{font-family:Arial;margin:0;background:#f3f4f6}
    .wrap{max-width:700px;margin:30px auto;padding:0 16px}
    .card{background:#fff;border-radius:14px;padding:18px;box-shadow:0 8px 20px rgba(0,0,0,.08)}
    label{font-weight:800;display:block;margin-top:12px}
    input{width:100%;padding:10px 12px;border-radius:10px;border:1px solid #ddd;margin-top:6px}
    .row{display:flex;gap:10px;flex-wrap:wrap;margin-top:16px}
    a,button{padding:10px 12px;border-radius:10px;text-decoration:none;border:0;cursor:pointer;font-weight:800}
    .primary{background:#2563eb;color:#fff}
    .muted{background:#e5e7eb;color:#111}
    .err{background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:10px 12px;border-radius:10px;margin-top:10px}
  </style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h2 style="margin:0">✏️ Editar usuario #{{ $usuario->id }}</h2>

    @if($errors->any())
      <div class="err">
        @foreach($errors->all() as $e)
          <div>• {{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
      @csrf
      @method('PUT')

      <label>Código</label>
      <input name="codigo" value="{{ old('codigo', $usuario->codigo) }}" required>

      <label>Nombre</label>
      <input name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>

      <label>Correo</label>
      <input name="correo" type="email" value="{{ old('correo', $usuario->correo) }}" required>

      <div class="row">
        <button class="primary" type="submit">Actualizar</button>
        <a class="muted" href="{{ route('usuarios.index') }}">Volver</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>