@extends('layouts.app')

@section('content')
    <h1><i class="fa-solid fa-plus"></i> Adicionar Veículo</h1>
    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf

        @error('model')
            <p>{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Modelo:</label>
            <input type="text" name="model" value="{{ old('model') }}">
        </div>

        @error('year')
                <p>{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Ano:</label>
            <input type="number" name="year" value="{{ old('year') }}">
        </div>

        @error('acquisition_date')
                <p>{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Data de aquisição:</label>
            <input type="date" name="acquisition_date" value="{{ old('acquisition_date') }}">
        </div>

        @error('km_at_acquisition')
                <p>{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Km na aquisição:</label>
            <input type="number" name="km_at_acquisition" value="{{ old('km_at_acquisition') }}">
        </div>

        @error('renavam')
                <p>{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Renavam:</label>
            <input type="text" name="renavam" value="{{ old('renavam') }}">
        </div>

        @error('license_plate')
                <p>{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Placa:</label>
            <input type="text" name="license_plate" value="{{ old('license_plate') }}">
        </div>

        <button type="submit">Salvar</button>
    </form>
@endsection
