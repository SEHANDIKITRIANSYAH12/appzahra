<?php

namespace App\Exports;

use App\Models\Cost;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class CostExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        return Cost::with('tractor')
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
            ->get()
            ->map(function ($cost) {
                return [
                    'Traktor' => $cost->tractor->type,
                    'Biaya Perawatan' => $cost->maintenance_cost,
                    'Gaji Operator' => $cost->operator_salary,
                    'Biaya Bahan Bakar' => $cost->fuel_cost,
                    'Area' => $cost->hectar_area,
                    'Total Biaya per ha' => $cost->calculateTotalCostPerHectar(),
                ];
            });
    }

    public function headings(): array
    {
        return ['Traktor', 'Biaya Perawatan', 'Gaji Operator', 'Biaya Bahan Bakar', 'Area (ha)', 'Total Biaya per ha'];
    }
}
