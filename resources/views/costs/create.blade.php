@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Biaya</h1>

    <form action="{{ route('costs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tractor_id">Traktor</label>
            <select name="tractor_id" class="form-control" id="tractor_id" required>
                <option value="">Pilih Traktor</option>
                @foreach ($tractors as $tractor)
                <option value="{{ $tractor->id }}">{{ $tractor->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="maintenance_cost">Biaya Perawatan</label>
            <input type="number" name="maintenance_cost" class="form-control" id="maintenance_cost" required>
        </div>
        <div class="form-group">
            <label for="operator_salary">Gaji Operator</label>
            <input type="number" name="operator_salary" class="form-control" id="operator_salary" required>
        </div>
        <div class="form-group">
            <label for="fuel_cost">Biaya Bahan Bakar</label>
            <input type="number" name="fuel_cost" class="form-control" id="fuel_cost" required>
        </div>
        <div class="form-group">
            <label for="hectar_area">Luas Lahan (hektar)</label>
            <input type="number" name="hectar_area" class="form-control" id="hectar_area" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
