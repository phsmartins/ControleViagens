@extends('layouts.app')

@section('content')
    <h1><i class="fa-solid fa-plus"></i> Adicionar Veículo</h1>
    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf

        <div class="input_box">
            @error('model')
                <p>{{ $message }}</p>
            @enderror
            <label>Modelo:</label>
            <input type="text" name="model" value="{{ old('model') }}">
        </div>

        <div class="input_box">
            @error('year')
                <p>{{ $message }}</p>
            @enderror
            <label>Ano:</label>
            <input type="number" name="year" value="{{ old('year') }}">
        </div>

        <div class="input_box">
            @error('acquisition_date')
                <p>{{ $message }}</p>
            @enderror
            <label>Data de aquisição:</label>
            <input type="date" name="acquisition_date" value="{{ old('acquisition_date') }}">
        </div>

        <div class="input_box">
            @error('km_at_acquisition')
                <p>{{ $message }}</p>
            @enderror
            <label>Km na aquisição:</label>
            <input type="number" name="km_at_acquisition" value="{{ old('km_at_acquisition') }}">
        </div>

        <div class="input_box">
            @error('renavam')
                <p>{{ $message }}</p>
            @enderror
            <label>Renavam:</label>
            <input type="text" name="renavam" value="{{ old('renavam') }}">
        </div>

        <div class="input_box">
            @error('license_plate')
                <p>{{ $message }}</p>
            @enderror
            <label>Placa:</label>
            <input type="text" name="license_plate" value="{{ old('license_plate') }}">
        </div>

        <button type="submit">Salvar</button>
    </form>
@endsection
