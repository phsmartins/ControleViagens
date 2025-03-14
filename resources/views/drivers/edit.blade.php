@extends('layouts.app')

@section('content')
    <h1 class="content_title"><i class="fa-solid fa-pen-to-square"></i> Editar Motorista</h1>

    <form action="{{ route('drivers.update', $driver) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input_box">
            @error('name')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>Nome completo:</label>
            <input type="text" name="name" value="{{ old('name', $driver->name) }}">
        </div>

        <div class="input_box">
            @error('birth_date')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>Data de nascimento:</label>
            <input type="date" name="birth_date" value="{{ old('birth_date', $driver->birth_date) }}">
        </div>

        <div class="input_box">
            @error('cnh')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>CNH:</label>
            <input type="text" name="cnh" value="{{ old('cnh', $driver->cnh) }}">
        </div>

        <div class="btn_box">
            <button class="btn_submit" type="submit">Atualizar</button>
        </div>
    </form>
@endsection
