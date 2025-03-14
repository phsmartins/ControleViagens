@extends('layouts.app')

@section('content')
    <h2>Editar Viagem Concluída</h2>

    <form action="{{ route('trips.update-completed', $trip->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input_box">
            @error('vehicle_id')
                <p>{{ $message }}</p>
            @enderror
            <label>Veículo</label>
            <select name="vehicle_id" id="vehicle_id">
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $vehicle->id == $trip->vehicle_id ? 'selected' : '' }}>
                        {{ $vehicle->model }} - {{ $vehicle->license_plate }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input_box">
            @error('drivers')
                <p>{{ $message }}</p>
            @enderror
            <label>Motoristas</label>
            <select name="drivers[]" id="drivers" multiple>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ in_array($driver->id, $trip->drivers->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input_box">
            @error('km_start')
                <p>{{ $message }}</p>
            @enderror
            <label>Quilometragem Inicial</label>
            <input type="number" name="km_start" value="{{ old('km_start', $trip->km_start) }}">
        </div>

        <div class="input_box">
            @error('km_end')
                <p>{{ $message }}</p>
            @enderror
            <label>Quilometragem Final</label>
            <input type="number" name="km_end" value="{{ old('km_end', $trip->km_end) }}">
        </div>

        <div class="input_box">
            @error('date_start')
                <p>{{ $message }}</p>
            @enderror
            <label>Data de Início</label>
            <input type="datetime-local" name="date_start" value="{{ old('date_start', \Carbon\Carbon::parse($trip->date_start)->format('Y-m-d\TH:i')) }}">
        </div>

        <div class="input_box">
            @error('date_end')
                <p>{{ $message }}</p>
            @enderror
            <label>Data de Término</label>
            <input type="datetime-local" name="date_end" value="{{ old('date_end', \Carbon\Carbon::parse($trip->date_end)->format('Y-m-d\TH:i')) }}">
        </div>

        <button type="submit">Atualizar Viagem</button>
        <a href="{{ route('trips.index') }}">Cancelar</a>
    </form>
@endsection
