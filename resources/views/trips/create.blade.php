@extends('layouts.app')

@section('content')
    <h1 class="content_title">Iniciar viagem</h1>

    <form action="{{ route('trips.store') }}" method="POST">
        @csrf

        <div class="input_box">
            @error('vehicle_id')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>Veículo:</label>
            <select name="vehicle_id">
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->model }} - {{ $vehicle->license_plate }}</option>
                @endforeach
            </select>
        </div>

        <div class="input_box">
            @error('drivers')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>Motoristas:</label>
            <select name="drivers[]" multiple>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="input_box">
            @error('date_start')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>Data e hora da viagem:</label>
            <input type="datetime-local" name="date_start">
        </div>

        <div class="input_box">
            @error('km_start')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>Km inicial:</label>
            <input type="number" name="km_start">
        </div>

        <div class="btn_box">
            <button class="btn_submit" type="submit">Iniciar viagem</button>
        </div>
    </form>
@endsection
