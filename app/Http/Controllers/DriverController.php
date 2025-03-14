<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverController extends Controller
{
    public function index(): View
    {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function create(): View
    {
        return view('drivers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'birth_date' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                'cnh' => 'required|string|unique:drivers,cnh|max:20',
            ],
            [
                'name.required' => 'Nome é obrigatório',

                'birth_date.required' => 'Data de nascimento é obrigatório',
                'birth_date.before_or_equal' => 'O motorista deve ter 18 ou mais de idade',

                'cnh.required' => 'CNH é obrigatório',
                'cnh.unique' => 'Este número de CNH já foi cadastrado no sistema',
            ]
        );

        Driver::create($validated);

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Motorista criado com sucesso');
    }

    public function show(int $id): View
    {
        $driver = Driver::with([
            'trips' => function ($query) {
                $query->orderByRaw("
                    CASE
                        WHEN status = 'ongoing' THEN 1
                        WHEN status = 'completed' THEN 2
                        ELSE 3
                    END
                ")->orderBy('date_start', 'desc');
            },
            'trips.vehicle'
        ])->findOrFail($id);

        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver): View
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'birth_date' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                'cnh' => 'required|string|unique:drivers,cnh,' . $driver->id . '|max:20',
            ],
            [
                'name.required' => 'Nome é obrigatório',

                'birth_date.required' => 'Data de nascimento é obrigatório',
                'birth_date.before_or_equal' => 'O motorista deve ter 18 ou mais de idade',

                'cnh.required' => 'CNH é obrigatório',
                'cnh.unique' => 'Este número de CNH já foi cadastrado no sistema',
            ]
        );

        $driver->update($validated);

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Motorista atualizado com sucesso');
    }

    public function destroy(Driver $driver): RedirectResponse
    {
        $driver->delete();
        return redirect()
            ->route('drivers.index')
            ->with('success', 'Motorista deletado com sucesso');
    }
}
