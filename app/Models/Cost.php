<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'tractor_id', 'maintenance_cost', 'operator_salary', 'fuel_cost', 'hectar_area'
    ];

    // Relasi dengan model Tractor
    public function tractor()
    {
        return $this->belongsTo(Tractor::class);
    }

    // Menghitung total biaya per hektar
    public function calculateTotalCostPerHectar()
    {
        $total_cost = $this->maintenance_cost + $this->operator_salary + $this->fuel_cost;
        return $total_cost / $this->hectar_area;
    }
}
