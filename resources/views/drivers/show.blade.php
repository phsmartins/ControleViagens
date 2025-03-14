@extends('layouts.app')

@section('content')
    <h1>{{ $driver->name }}</h1>

    <p>CNH: {{ $driver->cnh }}</p>
    <p>Data de nascimento: {{ $driver->getBirthDate() }}</p>
    <p>Idade: {{ $driver->getAge() }}</p>

    @if($driver->status === 'available')
        <p>Status: <i style="color: green" class="fa-solid fa-circle"></i> {{ $driver->status_text }}</p>
    @else
        <p>Status: <i style="color: red" class="fa-solid fa-circle"></i> {{ $driver->status_text }}</p>
    @endif

    <hr>

    <h2>Histórico de Viagens</h2>

    @if ($driver->trips->isEmpty())
        <p>Este motorista ainda não participou de nenhuma viagem</p>
    @else
        @foreach ($driver->trips as $trip)
            <div>
                <p>{{ $trip->vehicle->model }} - {{ $trip->vehicle->license_plate }}</p>
                <p>Data da viagem: {{ $trip->date_start_formatted }}</p>
                <p>Status: {{ $trip->status_text }}</p>
                <a href="{{ route('trips.show', $trip) }}" title="Ver Detalhes">Mais detalhes</a>
                <hr>
            </div>
        @endforeach
    @endif
@endsection
