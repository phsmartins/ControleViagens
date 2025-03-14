@extends('layouts.app')

@section('content')
    <div class="title_box">
        <h1 class="content_title"><i class="fa-solid fa-list"></i> Viagens em andamento</h1>
        <a class="link_new" href="{{ route('trips.create') }}"><i class="fa-solid fa-plus"></i> Inicar viagem</a>
    </div>

    @forelse($trips as $trip)
        <div class="list_box">
            <div>
                <h2 class="list_title">{{ $trip->vehicle->model }} - {{ $trip->vehicle->license_plate }}</h2>

                <p>Motoristas: {{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</p>
                <p>{{ $trip->date_start_formatted }}</p>
                <p><i class="fa-solid fa-circle on_trip"></i> {{ $trip->status_text }}</p>
            </div>

            <div class="actions_box">
                <div>
                    <a href="{{ route('trips.show', $trip) }}" title="Visualizar">
                        <i class="fa-solid fa-eye"></i> Mais detalhes
                    </a>
                </div>

                <div>
                    <a href="{{ route('trips.finish', $trip) }}">
                        <i class="fa-solid fa-lock"></i> Finalizar
                    </a>
                </div>
            </div>
        </div>
        <hr>
        @empty
            <p class="is_empty">Nenhuma viagem em andamento</p>
        @endforelse
@endsection
