@extends('layouts.app')

@section('content')
    <h1 class="content_title"><i class="fa-solid fa-flag-checkered"></i> Finalizar Viagem</h1>

    <form action="{{ route('trips.finish', $trip) }}" method="POST">
        @csrf

        <div class="input_box">
            @error('km_end')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>KM final:</label>
            <input type="number" name="km_end" value="{{ old('km_end') }}">
        </div>

        <div class="input_box">
            @error('date_end')
                <p class="msg_error">{{ $message }}</p>
            @enderror
            <label>Data e hora de chegada:</label>
            <input type="datetime-local" name="date_end">
        </div>

        <div class="btn_box">
            <button class="btn_submit" type="submit">Finalizar Viagem</button>
        </div>
    </form>
@endsection
