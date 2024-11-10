@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Traktor</h1>

    <form action="{{ route('tractors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Tipe Traktor</label>
            <input type="text" name="type" class="form-control" id="type" required>
        </div>
        <div class="form-group">
            <label for="power">Daya Traktor (HP)</label>
            <input type="number" name="power" class="form-control" id="power" required>
        </div>
        <div class="form-group">
            <label for="price">Harga Traktor</label>
            <input type="number" name="price" class="form-control" id="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
