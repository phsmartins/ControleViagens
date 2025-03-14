@extends('layouts.app')

@section('content')
    <div class="title_box">
        <h1 class="content_title">Viagens finalizadas</h1>
        <a class="link_new" href="{{ route('trips.create') }}"><i class="fa-solid fa-plus"></i> Iniciar viagem</a>
    </div>

    @if(session('success'))
        <p class="msg_success">{{ session('success') }}</p>
    @endif

    @php
        $completedTrips = $trips->where('status', 'completed');
    @endphp

    @forelse($completedTrips as $trip)
        <div class="list_box">
            <div>
                <h2 class="list_title">{{ $trip->vehicle->model }} - {{ $trip->vehicle->license_plate }}</h2>

                <p>Motoristas: {{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</p>
                <p>{{ $trip->date_start_formatted }} - {{ $trip->date_end_formatted }}</p>
                <p><i class="fa-solid fa-circle completed"></i> {{ $trip->status_text }}</p>
            </div>

            <div class="actions_box">
                <div>
                    <a href="{{ route('trips.show', $trip) }}" title="Visualizar">
                        <i class="fa-solid fa-eye"></i> Mais detalhes
                    </a>
                </div>

                <div>
                    <a href="{{ route('trips.edit-completed', $trip) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                </div>

                <div>
                    <form
                        action="{{ route('trips.destroy', $trip->id) }}"
                        method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir esta viagem?');"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Deletar">
                            <i class="fa-solid fa-trash"></i> Deletar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    @empty
        <p class="is_empty">Não há viagens finalizadas</p>
    @endforelse

    <h1 class="content_title">Viagens em aberto</h1>

    @php
        $ongoingTrips = $trips->where('status', 'ongoing');
    @endphp

    @forelse($ongoingTrips as $trip)
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
                    <a href="{{ route('trips.edit-ongoing', $trip) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                </div>

                <div>
                    <form
                        action="{{ route('trips.destroy', $trip->id) }}"
                        method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir esta viagem?');"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Deletar">
                            <i class="fa-solid fa-trash"></i> Deletar
                        </button>
                    </form>
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
        <p class="is_empty">Não há viagens em aberto</p>
    @endforelse
@endsection
