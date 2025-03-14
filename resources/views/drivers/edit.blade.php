@extends('layouts.app')

@section('content')
    <h1><i class="fa-solid fa-pen-to-square"></i> Editar Motorista</h1>

    <form action="{{ route('drivers.update', $driver) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input_box">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
            <label>Nome completo:</label>
            <input type="text" name="name" value="{{ old('name', $driver->name) }}">
        </div>

        <div class="input_box">
            @error('birth_date')
                <p>{{ $message }}</p>
            @enderror
            <label>Data de nascimento:</label>
            <input type="date" name="birth_date" value="{{ old('birth_date', $driver->birth_date) }}">
        </div>

        <div class="input_box">
            @error('cnh')
                <p>{{ $message }}</p>
            @enderror
            <label>CNH:</label>
            <input type="text" name="cnh" value="{{ old('cnh', $driver->cnh) }}">
        </div>

        <button type="submit">Atualizar</button>
        <a href="{{ route('drivers.index') }}">Cancelar atualização</a>
    </form>
@endsection
