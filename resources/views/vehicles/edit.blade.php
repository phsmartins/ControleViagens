@extends('layouts.app')

@section('content')
    <h1 class="content_title"><i class="fa-solid fa-pen-to-square"></i> Editar Veículo</h1>

    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
        @csrf
        @method('PUT')

        @error('model')
            <p class="msg_error">{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Modelo:</label>
            <input type="text" name="model" value="{{ $vehicle->model }}">
        </div>

        @error('year')
            <p class="msg_error">{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Ano:</label>
            <input type="number" name="year" value="{{ $vehicle->year }}">
        </div>

        @error('acquisition_date')
            <p class="msg_error">{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Data de aquisição:</label>
            <input type="date" name="acquisition_date" value="{{ $vehicle->acquisition_date }}">
        </div>

        @error('km_at_acquisition')
            <p class="msg_error">{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>KM na aquisição:</label>
            <input type="number" name="km_at_acquisition" value="{{ $vehicle->km_at_acquisition }}">
        </div>

        @error('renavam')
            <p class="msg_error">{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Renavam:</label>
            <input type="text" name="renavam" value="{{ $vehicle->renavam }}">
        </div>

        @error('license_plate')
            <p class="msg_error">{{ $message }}</p>
        @enderror
        <div class="input_box">
            <label>Placa:</label>
            <input type="text" name="license_plate" value="{{ $vehicle->license_plate }}">
        </div>

        <div class="btn_box">
            <button class="btn_submit" type="submit">Atualizar</button>
        </div>
    </form>
@endsection
