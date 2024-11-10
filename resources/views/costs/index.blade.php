@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Biaya</h1>

    <a href="{{ route('costs.create') }}" class="btn btn-primary mb-3">Tambah Biaya</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Traktor</th>
                <th>Biaya Perawatan</th>
                <th>Gaji Operator</th>
                <th>Biaya Bahan Bakar</th>
                <th>Total Biaya per Hektar</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($costs as $cost)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cost->tractor->type }}</td>
                <td>Rp. {{ number_format($cost->maintenance_cost, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($cost->operator_salary, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($cost->fuel_cost, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($cost->calculateTotalCostPerHectar(), 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('costs.edit', $cost->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('costs.destroy', $cost->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
