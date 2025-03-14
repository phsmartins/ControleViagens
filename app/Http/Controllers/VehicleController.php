<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        return view('vehicles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'model' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'acquisition_date' => 'required|date|before_or_equal:today',
                'km_at_acquisition' => 'required|integer|min:0',
                'renavam' => 'required|integer|unique:vehicles,renavam|digits:11',
                'license_plate' => 'required|string|unique:vehicles,license_plate|digits:7',
            ],
            [
                'model.required' => 'O modelo do veículo é obrigatório',

                'year.required' => 'O ano do veículo é obrigatório',
                'year.integer' => 'O ano do veículo deve ser um número inteiro',
                'year.min' => 'O ano no veículo não pode ser menor que 1900',
                'year.max' => 'O ano no veículo não pode ser maior que ' . date('Y'),

                'acquisition_date.required' => 'A data de aquisição do veículo é obrigatório',
                'acquisition_date.before_or_equal' => 'A data não pode ser maior que a data atual',

                'km_at_acquisition.required' => 'A quilometragem do veículo é obrigatório',
                'km_at_acquisition.min' => 'A quilometragem do veículo não pode ser negativa',
                'km_at_acquisition.integer' => 'O Km deve ser um número inteiro',

                'renavam.required' => 'Renavam é um campo obrigatório',
                'renavam.unique' => 'Este renavam já está cadastrado em outro veículo',
                'renavam.digits' => 'Renavam inválido',
                'renavam.integer' => 'Renavam deve ser um número',

                'license_plate.required' => 'A placa do veículo é obrigatório',
                'license_plate.unique' => 'Esta placa já está cadastrado em outro veículo',
                'license_plate.digits' => 'Digite uma placa válida',
            ]
        );

        Vehicle::create($validated);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Veículo adicionado com sucesso');
    }

    public function edit(Vehicle $vehicle): View
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $validated = $request->validate(
            [
                'model' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'acquisition_date' => 'required|date|before_or_equal:today',
                'km_at_acquisition' => 'required|integer|min:0',
                'renavam' => 'required|string|unique:vehicles,renavam,' . $vehicle->id,
                'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            ],
            [
                'model.required' => 'O modelo do veículo é obrigatório',

                'year.required' => 'O ano do veículo é obrigatório',
                'year.integer' => 'O ano do veículo deve ser um número inteiro',
                'year.min' => 'O ano no veículo não pode ser menor que 1900',
                'year.max' => 'O ano no veículo não pode ser maior que ' . date('Y'),

                'acquisition_date.required' => 'A data de aquisição do veículo é obrigatório',
                'acquisition_date.before_or_equal' => 'A data não pode ser maior que a data atual',

                'km_at_acquisition.required' => 'A quilometragem do veículo é obrigatório',
                'km_at_acquisition.min' => 'A quilometragem do veículo não pode ser negativa',

                'renavam.required' => 'Renavam é um campo obrigatório',
                'renavam.unique' => 'Este renavam já está cadastrado em outro veículo',

                'license_plate.required' => 'A placa do veículo é obrigatório',
                'license_plate.unique' => 'Esta placa já está cadastrado em outro veículo',
            ]
        );

        $vehicle->update($validated);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Veículo atualizado com sucesso');
    }

    public function show(int $id): View
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Veículo deletado com sucesso');
    }
}
