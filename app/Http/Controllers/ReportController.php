<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Tractor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CostExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    // Menampilkan halaman laporan
    public function index(Request $request)
    {
        // Mengambil data filter bulan dan tahun
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->format('Y'));

        // Mengambil data biaya berdasarkan bulan dan tahun yang dipilih
        $costs = Cost::with('tractor')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        // Menghitung total biaya dan total per hektar
        $totalCost = $costs->sum(function ($cost) {
            return $cost->maintenance_cost + $cost->operator_salary + $cost->fuel_cost;
        });

        $totalArea = $costs->sum('hectar_area');
        $totalCostPerHectar = $totalArea ? $totalCost / $totalArea : 0;

        return view('reports.index', compact('costs', 'month', 'year', 'totalCost', 'totalCostPerHectar'));
    }

    // Ekspor laporan ke PDF
   // Pada fungsi exportPdf di ReportController
public function exportPdf(Request $request)
{
    $month = $request->input('month', Carbon::now()->format('m'));
    $year = $request->input('year', Carbon::now()->format('Y'));

    $costs = Cost::with('tractor')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();

    // Menghitung total biaya dan total per hektar
    $totalCost = $costs->sum(function ($cost) {
        return $cost->maintenance_cost + $cost->operator_salary + $cost->fuel_cost;
    });

    $totalArea = $costs->sum('hectar_area');
    $totalCostPerHectar = $totalArea ? $totalCost / $totalArea : 0;

    // Mengirim data ke view PDF
    $pdf = Pdf::loadView('reports.pdf', compact('costs', 'month', 'year', 'totalCost', 'totalCostPerHectar'));
    return $pdf->download("laporan-biaya-$month-$year.pdf");
}


    // Ekspor laporan ke Excel
    public function exportExcel(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->format('Y'));

        return Excel::download(new CostExport($month, $year), "laporan-biaya-$month-$year.xlsx");
    }
}
