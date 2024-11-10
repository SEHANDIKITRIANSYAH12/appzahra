@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Biaya</h1>

    <form action="{{ route('costs.update', $cost->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
