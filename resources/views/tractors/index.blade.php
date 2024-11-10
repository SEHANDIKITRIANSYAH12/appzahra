@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Traktor</h1>

    <a href="{{ route('tractors.create') }}" class="btn btn-primary mb-3">Tambah Traktor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Daya</th>
                <th>Harga</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tractors as $tractor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tractor->type }}</td>
                <td>{{ $tractor->power }} HP</td>
                <td>Rp. {{ number_format($tractor->price, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('tractors.edit', $tractor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tractors.destroy', $tractor->id) }}" method="POST" style="display:inline;">
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
