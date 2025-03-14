@extends('layouts.app')

@section('content')
    <h1><i class="fa-solid fa-id-card"></i> Motoristas</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($drivers->isEmpty())
        <p>Nenhum motorista cadastrado</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>CNH</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td><a href="{{ route('drivers.show', $driver) }}">{{ $driver->name }}</a></td>
                    <td>{{ $driver->getAge() }}</td>
                    <td>{{ $driver->cnh }}</td>
                    <td>
                        <a href="{{ route('drivers.edit', $driver) }}" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Deletar"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <a href="{{ route('drivers.show', $driver) }}" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
