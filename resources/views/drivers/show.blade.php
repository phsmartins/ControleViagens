@extends('layouts.app')

@section('content')
    <h1 class="content_title">{{ $driver->name }}</h1>

    <div class="show_list">
        <p><strong>CNH:</strong> {{ $driver->cnh }}</p>
        <p><strong>Data de nascimento:</strong>  {{ $driver->getBirthDate() }}</p>
        <p><strong>Idade:</strong>  {{ $driver->getAge() }}</p>

        @if($driver->status === 'available')
            <p><strong>Status:</strong>  <i style="color: green" class="fa-solid fa-circle"></i> {{ $driver->status_text }}</p>
        @elseif($driver->status === 'on_trip')
            <p><strong>Status:</strong>  <i style="color: red" class="fa-solid fa-circle"></i> {{ $driver->status_text }}</p>
        @else
            <p><strong>Status:</strong>  <i class="fa-solid fa-circle"></i> {{ $driver->status_text }}</p>
        @endif
    </div>

    <h2 class="content_title">Histórico de Viagens</h2>

    @if ($driver->trips->isEmpty())
        <p class="is_empty">Este motorista ainda não participou de nenhuma viagem</p>
    @else
        @foreach ($driver->trips as $trip)
            <div class="show_list" style="margin-bottom: 3rem">
                <p><strong>Veículo: </strong>{{ $trip->vehicle->model }} - {{ $trip->vehicle->license_plate }}</p>
                <p><strong>Data da viagem:</strong>  {{ $trip->date_start_formatted }}</p>
                <p><strong>Status:</strong>  {{ $trip->status_text }}</p>
                <a class="more_details" href="{{ route('trips.show', $trip) }}" title="Ver Detalhes">Mais detalhes</a>
                <hr>
            </div>
        @endforeach
    @endif
@endsection
