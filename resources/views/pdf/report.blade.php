<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Tareas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 18px; margin-bottom: 0; }
        .subtitle { color: #666; margin-top: 4px; margin-bottom: 20px; }
        .summary { display: table; width: 100%; margin-bottom: 20px; }
        .summary-item {
            display: table-cell; width: 25%; text-align: center;
            border: 1px solid #ddd; padding: 10px; background: #f7f7f7;
        }
        .summary-item .value { font-size: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; font-size: 11px; }
        th { background: #343a40; color: #fff; }
        tr:nth-child(even) { background: #f9f9f9; }
        .badge { padding: 2px 6px; border-radius: 4px; color: #fff; font-size: 10px; }
        .status-pending { background: #6c757d; }
        .status-in_progress { background: #0d6efd; }
        .status-done { background: #198754; }
        footer { position: fixed; bottom: -20px; font-size: 9px; color: #999; }
    </style>
</head>
<body>
    <h1>Reporte de Tareas del Sistema</h1>
    <p class="subtitle">Generado el {{ $generatedAt->format('d/m/Y H:i') }}</p>

    <div class="summary">
        <div class="summary-item">
            <div class="value">{{ $summary['total'] }}</div>
            <div>Total</div>
        </div>
        <div class="summary-item">
            <div class="value">{{ $summary['pending'] }}</div>
            <div>Pendientes</div>
        </div>
        <div class="summary-item">
            <div class="value">{{ $summary['in_progress'] }}</div>
            <div>En progreso</div>
        </div>
        <div class="summary-item">
            <div class="value">{{ $summary['done'] }}</div>
            <div>Completadas</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Creada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td><span class="badge status-{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span></td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ $task->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>Hackathon Base &middot; Reporte generado automáticamente</footer>
</body>
</html>
