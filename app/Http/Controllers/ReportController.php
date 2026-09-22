<?php

namespace App\Http\Controllers;

use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(private ReportService $reportService)
    {
    }

    // Ruta protegida por middleware 'admin' en routes/api.php
    public function tasksReport()
    {
        $pdf = $this->reportService->generateTasksReport();

        return $pdf->stream('reporte-tareas.pdf');
        // Alternativa para forzar descarga: return $pdf->download('reporte-tareas.pdf');
    }
}
