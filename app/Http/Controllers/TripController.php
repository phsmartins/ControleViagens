<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripController extends Controller
{
    public function index(): View
    {
        $trips = Trip::with(['vehicle', 'drivers'])->get();
        return view('trips.index', compact('trips'));
    }

    public function create(): View
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        $drivers = Driver::where('status', 'available')->get();
        return view('trips.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        $validated = $request->validate(
            [
                'vehicle_id' => 'required|exists:vehicles,id',
                'drivers' => 'required|array',
                'drivers.*' => 'exists:drivers,id',
                'date_start' => 'required|date',
                'km_start' => 'required|integer|min:' . $vehicle->km_at_acquisition,
            ],
            [
                'vehicle_id.required' => 'O veículo é obrigatório',
                'vehicle_id.exists' => 'O veículo selecionado não existe',

                'drivers.required' => 'É necessário selecionar pelo menos um motorista',
                'drivers.*.exists' => 'Um dos motoristas selecionados não existe',

                'date_start.required' => 'A data de início é obrigatória',
                'date_start.date' => 'A data de início deve ser uma data válida',

                'km_start.required' => 'O Km inicial é obrigatório',
                'km_start.integer' => 'O Km inicial deve ser um número inteiro',
                'km_start.min' => 'O Km inicial não pode ser menor que ' . $vehicle->km_at_acquisition_formatted . ' Km',
            ]
        );

        $trip = Trip::create([
            'vehicle_id' => $validated['vehicle_id'],
            'km_start' => $validated['km_start'],
            'date_start' => $validated['date_start'],
            'status' => 'ongoing',
        ]);

        $trip->drivers()->attach($validated['drivers']);

        Vehicle::where('id', $validated['vehicle_id'])->update(['status' => 'on_trip']);
        Driver::whereIn('id', $validated['drivers'])->update(['status' => 'on_trip']);

        return redirect()
            ->route('trips.index')
            ->with('success', 'Viagem iniciada com sucesso');
    }

    public function show(Trip $trip): View
    {
        return view('trips.show', compact('trip'));
    }

    public function editOngoing(Trip $trip): View
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('trips.edit-ongoing', compact('trip', 'vehicles', 'drivers'));
    }

    public function updateOngoing(Request $request, Trip $trip): RedirectResponse
    {
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        $validated = $request->validate(
            [
                'km_start' => 'required|integer|min:' . $vehicle->km_at_acquisition,
                'date_start' => 'required|date',
            ],
            [
                'date_start.required' => 'A data de início é obrigatória',
                'date_start.date' => 'A data de início deve ser uma data válida',

                'km_start.required' => 'O Km inicial é obrigatório',
                'km_start.integer' => 'O Km inicial deve ser um número inteiro',
                'km_start.min' => 'O Km inicial não pode ser menor que ' . $vehicle->km_at_acquisition_formatted . ' Km',
            ]
        );

        $trip->update($validated);

        return redirect()
            ->route('trips.index')
            ->with('success', 'Viagem atualizada com sucesso');
    }

    public function editCompleted(Trip $trip): View
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('trips.edit-completed', compact('trip', 'vehicles', 'drivers'));
    }

    public function updateCompleted(Request $request, Trip $trip): RedirectResponse
    {
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        $validated = $request->validate(
            [
                'vehicle_id' => 'required|exists:vehicles,id',
                'drivers' => 'required|array',
                'drivers.*' => 'exists:drivers,id',
                'km_start' => 'required|integer|min:0',
                'km_end' => 'required|integer|min:' . $trip->km_start,
                'date_start' => 'required|date',
                'date_end' => 'required|date|after:' . $trip->date_start,
            ],
            [
                'vehicle_id.required' => 'O veículo é obrigatório',
                'vehicle_id.exists' => 'O veículo selecionado não existe',

                'drivers.required' => 'É necessário selecionar pelo menos um motorista',
                'drivers.*.exists' => 'Um dos motoristas selecionados não existe',

                'km_start.required' => 'O Km inicial é obrigatório',
                'km_start.integer' => 'O Km inicial deve ser um número inteiro',
                'km_start.min' => 'O Km inicial não pode ser menor que ' . $vehicle->km_at_acquisition_formatted . ' Km',

                'km_end.required' => 'Km final é obrigatório',
                'km_end.integer' => 'Km final deve ser um número inteiro',
                'km_end.min' => 'O Km final não pode ser menor que ' . $trip->km_start . ' Km',

                'date_start.required' => 'A data de início é obrigatória',
                'date_start.date' => 'A data de início deve ser uma data válida',

                'date_end.required' => 'A data de final é obrigatória',
                'date_end.date' => 'A data de final deve ser uma data válida',
                'date_end.after' => 'A data de final deve ser depois que a data inicial',
            ]
        );

        $trip->update($validated);
        $trip->drivers()->sync($validated['drivers']);
        return redirect()
            ->route('trips.index')
            ->with('success', 'Viagem finalizada atualizada com sucesso');
    }

    public function finishForm(Trip $trip): View
    {
        return view('trips.finish', compact('trip'));
    }

    public function finish(Request $request, Trip $trip): RedirectResponse
    {
        $validated = $request->validate(
            [
                'km_end' => 'required|integer|min:' . $trip->km_start,
                'date_end' => 'required|date|after:' . $trip->date_start,
            ],
            [
                'km_end.required' => 'Km final é obrigatório',
                'km_end.integer' => 'Km final deve ser um número inteiro',
                'km_end.min' => 'O Km final não pode ser menor que ' . $trip->km_start . ' Km',

                'date_end.required' => 'A data de final é obrigatória',
                'date_end.date' => 'A data de final deve ser uma data válida',
                'date_end.after' => 'A data de final deve ser depois que a data inicial',
            ]
        );

        $trip->update([
            'km_end' => $validated['km_end'],
            'date_end' => $validated['date_end'],
            'status' => 'completed',
        ]);

        $trip->vehicle->update(['status' => 'available']);
        $trip->drivers()->update(['status' => 'available']);

        return redirect()
            ->route('trips.index')
            ->with('success', 'Viagem finalizada com sucesso');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        if ($trip->status === 'ongoing') {
            $trip->vehicle->update(['status' => 'available']);
            $trip->drivers()->update(['status' => 'available']);
        }

        $trip->delete();

        return redirect()
            ->route('trips.index')
            ->with('success', 'Viagem removida com sucesso');
    }
}
