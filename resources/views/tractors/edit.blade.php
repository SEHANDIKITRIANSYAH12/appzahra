@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Traktor</h1>

    <form action="{{ route('tractors.update', $tractor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">Tipe Traktor</label>
            <input type="text" name="type" class="form-control" id="type" value="{{ $tractor->type }}" required>
        </div>
        <div class="form-group">
            <label for="power">Daya Traktor (HP)</label>
            <input type="number" name="power" class="form-control" id="power" value="{{ $tractor->power }}" required>
        </div>
        <div class="form-group">
            <label for="price">Harga Traktor</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ $tractor->price }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
