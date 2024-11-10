@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Laporan Biaya Bulanan</h1>

    <!-- Form untuk memilih bulan dan tahun -->
    <form method="GET" action="{{ route('reports.index') }}">
        <div class="form-group">
            <label for="month">Bulan:</label>
            <input type="number" id="month" name="month" class="form-control" value="{{ $month }}" min="1" max="12">
        </div>

        <div class="form-group">
            <label for="year">Tahun:</label>
            <input type="number" id="year" name="year" class="form-control" value="{{ $year }}" min="2020">
        </div>

        <button type="submit" class="btn btn-primary">Tampilkan</button>
        <a href="{{ route('reports.exportPdf', ['month' => $month, 'year' => $year]) }}" class="btn btn-danger">Export PDF</a>
        <a href="{{ route('reports.exportExcel', ['month' => $month, 'year' => $year]) }}" class="btn btn-success">Export Excel</a>
    </form>

    <!-- Tabel untuk menampilkan data laporan biaya -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Traktor</th>
                <th>Biaya Perawatan</th>
                <th>Gaji Operator</th>
                <th>Biaya Bahan Bakar</th>
                <th>Area (Hectar)</th>
                <th>Total Biaya per Hectar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($costs as $cost)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cost->tractor->type }}</td>
                <td>{{ number_format($cost->maintenance_cost, 0, ',', '.') }}</td>
                <td>{{ number_format($cost->operator_salary, 0, ',', '.') }}</td>
                <td>{{ number_format($cost->fuel_cost, 0, ',', '.') }}</td>
                <td>{{ number_format($cost->hectar_area, 0, ',', '.') }}</td>
                <td>{{ number_format($cost->calculateTotalCostPerHectar(), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menampilkan total biaya dan total biaya per hektar -->
    <h4>Total Biaya: {{ number_format($totalCost, 0, ',', '.') }}</h4>
    <h4>Total Biaya Per Hectar: {{ number_format($totalCostPerHectar, 0, ',', '.') }}</h4>
</div>
@endsection
