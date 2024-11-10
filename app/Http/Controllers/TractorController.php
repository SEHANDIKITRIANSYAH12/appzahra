<?php

namespace App\Http\Controllers;

use App\Models\Tractor;
use Illuminate\Http\Request;

class TractorController extends Controller
{
    public function index()
    {
        $tractors = Tractor::all();
        return view('tractors.index', compact('tractors'));
    }

    public function create()
    {
        return view('tractors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'power' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        Tractor::create($request->all());

        return redirect()->route('tractors.index')->with('success', 'Traktor berhasil ditambahkan.');
    }

    

    public function edit(Tractor $tractor)
    {
        return view('tractors.edit', compact('tractor'));
    }

    public function update(Request $request, Tractor $tractor)
    {
        $request->validate([
            'type' => 'required',
            'power' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $tractor->update($request->all());

        return redirect()->route('tractors.index')->with('success', 'Traktor berhasil diperbarui.');
    }

    public function destroy(Tractor $tractor)
    {
        $tractor->delete();
        return redirect()->route('tractors.index')->with('success', 'Traktor berhasil dihapus.');
    }
}
