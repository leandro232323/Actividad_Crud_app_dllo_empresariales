<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Gestión de Usuarios</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --cream:    #faf7f2;
      --white:    #ffffff;
      --sand:     #f0ead8;
      --sand-mid: #e5dcc8;
      --accent:   #b45309;       /* ámbar profesional */
      --accent-lt:#fef3c7;
      --ink:      #1c1917;
      --ink-mid:  #44403c;
      --ink-lt:   #78716c;
      --border:   #e7e0d0;
      --success:  #166534;
      --success-bg:#dcfce7;
      --danger:   #991b1b;
      --danger-bg:#fee2e2;
      --shadow-sm: 0 1px 3px rgba(28,25,23,.08), 0 1px 2px rgba(28,25,23,.05);
      --shadow-md: 0 4px 16px rgba(28,25,23,.10), 0 1px 4px rgba(28,25,23,.06);
      --shadow-lg: 0 12px 40px rgba(28,25,23,.12), 0 2px 8px rgba(28,25,23,.06);
      --radius:   16px;
      --radius-sm:10px;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--cream);
      color: var(--ink);
      min-height: 100vh;
      background-image:
        radial-gradient(ellipse 80% 50% at 50% -10%, rgba(180,83,9,.07) 0%, transparent 60%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='1' fill='%23b4530920'/%3E%3C/svg%3E");
    }

    /* ── LAYOUT ── */
    .wrap {
      max-width: 1080px;
      margin: 0 auto;
      padding: 40px 20px 60px;
    }

    /* ── PAGE HEADER ── */
    .page-header {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      margin-bottom: 28px;
    }
    .page-header-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .page-icon {
      width: 52px; height: 52px;
      background: var(--accent);
      border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      font-size: 22px;
      box-shadow: 0 4px 12px rgba(180,83,9,.30);
      flex-shrink: 0;
    }
    .page-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: var(--ink);
      line-height: 1.1;
      letter-spacing: -.3px;
    }
    .page-title p {
      font-size: 14px;
      color: var(--ink-lt);
      margin-top: 3px;
      font-weight: 300;
    }

    /* ── CARD ── */
    .card {
      background: var(--white);
      border-radius: var(--radius);
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--border);
      overflow: hidden;
    }
    .card-body { padding: 24px; }

    /* ── TOOLBAR ── */
    .toolbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      padding: 20px 24px;
      border-bottom: 1px solid var(--border);
      background: var(--sand);
    }
    .search-form {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .search-wrap {
      position: relative;
    }
    .search-wrap svg {
      position: absolute;
      left: 12px; top: 50%;
      transform: translateY(-50%);
      color: var(--ink-lt);
      pointer-events: none;
    }
    .search-wrap input {
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      padding: 10px 14px 10px 38px;
      border-radius: var(--radius-sm);
      border: 1.5px solid var(--sand-mid);
      background: var(--white);
      color: var(--ink);
      width: 300px;
      transition: border-color .2s, box-shadow .2s;
      outline: none;
    }
    .search-wrap input::placeholder { color: var(--ink-lt); font-weight: 300; }
    .search-wrap input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(180,83,9,.12);
    }

    /* ── BUTTONS ── */
    .btn {
      font-family: 'DM Sans', sans-serif;
      display: inline-flex; align-items: center; gap: 6px;
      padding: 10px 18px;
      border-radius: var(--radius-sm);
      border: 0; cursor: pointer;
      font-size: 14px; font-weight: 600;
      text-decoration: none;
      transition: transform .15s, box-shadow .15s, background .15s;
      white-space: nowrap;
      line-height: 1;
    }
    .btn:active { transform: translateY(1px); }

    .btn-primary {
      background: var(--accent);
      color: #fff;
      box-shadow: 0 3px 10px rgba(180,83,9,.30);
    }
    .btn-primary:hover {
      background: #92400e;
      box-shadow: 0 5px 16px rgba(180,83,9,.38);
      transform: translateY(-1px);
    }

    .btn-ghost {
      background: var(--white);
      color: var(--ink-mid);
      border: 1.5px solid var(--border);
    }
    .btn-ghost:hover { background: var(--sand); border-color: var(--sand-mid); }

    .btn-edit {
      background: #eff6ff;
      color: #1d4ed8;
      border: 1.5px solid #bfdbfe;
      padding: 7px 14px;
      font-size: 13px;
    }
    .btn-edit:hover { background: #dbeafe; }

    .btn-delete {
      background: var(--danger-bg);
      color: var(--danger);
      border: 1.5px solid #fecaca;
      padding: 7px 14px;
      font-size: 13px;
    }
    .btn-delete:hover { background: #fecaca; }

    /* ── ALERT ── */
    .alert {
      display: flex; align-items: center; gap: 10px;
      padding: 12px 16px;
      border-radius: var(--radius-sm);
      font-size: 14px;
      font-weight: 500;
      margin: 0 24px 0;
      border: 1.5px solid;
    }
    .alert-success {
      background: var(--success-bg);
      border-color: #86efac;
      color: var(--success);
    }
    .alert-spacer { height: 20px; }

    /* ── TABLE ── */
    .table-wrap { overflow-x: auto; }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    thead tr {
      background: var(--sand);
      border-bottom: 2px solid var(--sand-mid);
    }
    th {
      padding: 13px 20px;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .8px;
      color: var(--ink-lt);
      text-align: left;
      white-space: nowrap;
    }
    td {
      padding: 14px 20px;
      font-size: 14px;
      color: var(--ink-mid);
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
    }
    tbody tr {
      transition: background .15s;
    }
    tbody tr:hover { background: #fdf8f3; }
    tbody tr:last-child td { border-bottom: 0; }

    .td-id {
      font-size: 12px;
      color: var(--ink-lt);
      font-weight: 500;
    }
    .td-code {
      font-family: 'DM Mono', 'Courier New', monospace;
      font-size: 13px;
      background: var(--sand);
      color: var(--accent);
      padding: 3px 8px;
      border-radius: 6px;
      display: inline-block;
      font-weight: 600;
      letter-spacing: .4px;
      border: 1px solid var(--sand-mid);
    }
    .td-name { font-weight: 500; color: var(--ink); }
    .td-email { color: var(--ink-lt); font-size: 13px; }
    .td-actions { display: flex; align-items: center; gap: 8px; }

    /* ── AVATAR BADGE ── */
    .avatar {
      width: 32px; height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent) 0%, #d97706 100%);
      color: #fff;
      font-size: 12px;
      font-weight: 700;
      display: inline-flex;
      align-items: center; justify-content: center;
      margin-right: 8px;
      flex-shrink: 0;
      box-shadow: 0 2px 6px rgba(180,83,9,.25);
    }
    .name-cell { display: flex; align-items: center; }

    /* ── EMPTY STATE ── */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
    }
    .empty-state .empty-icon {
      font-size: 48px;
      margin-bottom: 12px;
      opacity: .4;
    }
    .empty-state p {
      color: var(--ink-lt);
      font-size: 15px;
    }

    /* ── FOOTER / PAGINATION ── */
    .card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      padding: 16px 24px;
      border-top: 1px solid var(--border);
      background: var(--sand);
    }
    .pager { display: flex; align-items: center; gap: 6px; }
    .pager a, .pager span {
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 500;
      padding: 7px 11px;
      border-radius: 8px;
      text-decoration: none;
      color: var(--ink-mid);
      background: var(--white);
      border: 1.5px solid var(--border);
      transition: all .15s;
    }
    .pager a:hover {
      background: var(--accent);
      color: #fff;
      border-color: var(--accent);
    }
    .pager span.current {
      background: var(--accent);
      color: #fff;
      border-color: var(--accent);
    }
    .results-count {
      font-size: 13px;
      color: var(--ink-lt);
    }
    .results-count strong { color: var(--ink-mid); font-weight: 600; }
  </style>
</head>
<body>
<div class="wrap">

  <!-- PAGE HEADER -->
  <div class="page-header">
    <div class="page-header-left">
      <div class="page-icon">👥</div>
      <div class="page-title">
        <h1>Gestión de Usuarios</h1>
        <p>Administra los usuarios registrados en el sistema</p>
      </div>
    </div>
    <a class="btn btn-primary" href="{{ route('usuarios.create') }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
      Nuevo Usuario
    </a>
  </div>

  <!-- CARD -->
  <div class="card">

    <!-- TOOLBAR -->
    <div class="toolbar">
      <form method="GET" action="{{ route('usuarios.index') }}" class="search-form">
        <div class="search-wrap">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
          </svg>
          <input name="q" value="{{ $q }}" placeholder="Buscar por código, nombre o correo…" autocomplete="off">
        </div>
        <button class="btn btn-primary" type="submit">Buscar</button>
        <a class="btn btn-ghost" href="{{ route('usuarios.index') }}">Limpiar</a>
      </form>
    </div>

    <!-- SUCCESS ALERT -->
    @if(session('ok'))
      <div style="padding: 16px 24px 0;">
        <div class="alert alert-success">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
          {{ session('ok') }}
        </div>
      </div>
    @endif

    <!-- TABLE -->
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse($usuarios as $u)
            <tr>
              <td><span class="td-id">#{{ $u->id }}</span></td>
              <td><span class="td-code">{{ $u->codigo }}</span></td>
              <td>
                <div class="name-cell">
                  <div class="avatar">{{ strtoupper(substr($u->nombre, 0, 1)) }}</div>
                  <span class="td-name">{{ $u->nombre }}</span>
                </div>
              </td>
              <td>
                <span class="td-email">
                  <svg style="vertical-align:-2px;margin-right:4px" width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                  {{ $u->correo }}
                </span>
              </td>
              <td>
                <div class="td-actions">
                  <a class="btn btn-edit" href="{{ route('usuarios.edit', $u) }}">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
                    Editar
                  </a>
                  <form action="{{ route('usuarios.destroy', $u) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?')" type="submit">
                      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/></svg>
                      Eliminar
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">
                <div class="empty-state">
                  <div class="empty-icon">🔍</div>
                  <p>No se encontraron usuarios registrados.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- FOOTER / PAGER -->
    <div class="card-footer">
      <span class="results-count">
        Mostrando <strong>{{ $usuarios->count() }}</strong> de <strong>{{ $usuarios->total() }}</strong> usuarios
      </span>
      <div class="pager">
        {{ $usuarios->links() }}
      </div>
    </div>

  </div><!-- /card -->
</div><!-- /wrap -->
</body>
</html>