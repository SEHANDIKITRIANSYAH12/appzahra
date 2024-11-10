<?php
namespace App\Http\Controllers;

use App\Models\Tractor;
use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function index()
    {
        $costs = Cost::with('tractor')->get();
        return view('costs.index', compact('costs'));
    }

    public function create()
    {
        $tractors = Tractor::all();
        return view('costs.create', compact('tractors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tractor_id' => 'required|exists:tractors,id',
            'maintenance_cost' => 'required|numeric',
            'operator_salary' => 'required|numeric',
            'fuel_cost' => 'required|numeric',
            'area' => 'required|numeric'
        ]);

        $totalCostPerHectare = ($request->maintenance_cost + $request->operator_salary + $request->fuel_cost) / $request->area;

        Cost::create([
            'tractor_id' => $request->tractor_id,
            'maintenance_cost' => $request->maintenance_cost,
            'operator_salary' => $request->operator_salary,
            'fuel_cost' => $request->fuel_cost,
            'area' => $request->area,
            'total_cost_per_hectare' => $totalCostPerHectare
        ]);

        return redirect()->route('costs.index')->with('success', 'Cost added successfully.');
    }

    public function destroy($id)
    {
        $cost = Cost::findOrFail($id);
        $cost->delete();
        return redirect()->route('costs.index')->with('success', 'Cost deleted successfully.');
    }
}
