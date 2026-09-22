<?php

namespace App\Services;

use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Genera reportes PDF a partir de datos agregados y transaccionales.
 * Separado de TaskService porque tiene una responsabilidad distinta:
 * "presentar información", no "gestionar el ciclo de vida de una tarea".
 */
class ReportService
{
    public function generateTasksReport(): \Barryvdh\DomPDF\PDF
    {
        $tasks = Task::with('user')->latest()->get();

        $summary = [
            'total' => $tasks->count(),
            'pending' => $tasks->where('status', 'pending')->count(),
            'in_progress' => $tasks->where('status', 'in_progress')->count(),
            'done' => $tasks->where('status', 'done')->count(),
            'by_priority' => $tasks->groupBy('priority')->map->count(),
        ];

        return Pdf::loadView('pdf.report', [
            'tasks' => $tasks,
            'summary' => $summary,
            'generatedAt' => now(),
        ])->setPaper('a4', 'portrait');
    }
}
