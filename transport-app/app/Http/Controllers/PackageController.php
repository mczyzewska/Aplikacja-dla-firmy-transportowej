<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Client;
use App\Models\Courier;
use App\Models\Warehouse;
use App\Models\PickupPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'employee'])) abort(403);

        // Logika sekwencyjnego numerowania (TRK200001...)
        $lastPackage = Package::where('tracking_number', 'LIKE', 'TRK%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastPackage) {
            $lastNumber = (int) filter_var($lastPackage->tracking_number, FILTER_SANITIZE_NUMBER_INT);
            $suggestedNumber = 'TRK' . ($lastNumber + 1);
        } else {
            $suggestedNumber = 'TRK200000';
        }

        return view('packages.index', [
            'packages' => Package::with(['client', 'pickupPoint', 'courier'])->latest()->get(),
            'clients' => Client::orderBy('name')->get(),
            'pickupPoints' => PickupPoint::orderBy('city')->get(),
            'couriers' => Courier::orderBy('company')->get(), // Zmienione na company dla czytelności
            'warehouses' => Warehouse::all(),
            'suggestedNumber' => $suggestedNumber,
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'tracking_number' => 'required|string|unique:packages,tracking_number',
        'client_id'       => 'required|exists:clients,id',
        'pickup_point_id' => 'required|exists:pickup_points,id',
        'courier_id'      => 'required|exists:couriers,id',
        'warehouse_id'    => 'required|exists:warehouses,id',
        'weight'          => 'required|numeric|min:0.01',
    ], [
        'required'    => 'To pole musi zostać uzupełnione.',
        'unique'      => 'Ten numer TRK już istnieje.',
        'numeric'     => 'Wprowadź poprawną wartość liczbową.',
        
        'weight.min'  => 'Waga musi wynosić co najmniej 0.01 kg.', 
        'min.numeric' => 'Wartość w polu :attribute musi być większa niż :min.',

    ]);

    // Wymuszamy domyślny status przy przyjęciu paczki
    $validated['status'] = 'odebrana';

    DB::transaction(function () use ($validated) {
        $package = Package::create($validated);
        
        // Zapis do historii statusów
        PackageStatus::create([
            'package_id' => $package->id,
            'status'     => 'odebrana',
            'changed_at' => now(),
        ]);
    });

    return redirect()->back()->with('success', 'Paczka została zarejestrowana w systemie.');
}

public function edit(Package $package)
{
    return view('packages.edit', [
        'package' => $package,
        'clients' => Client::all(),
        'pickupPoints' => PickupPoint::all(),
        'couriers' => Courier::all(),
        'warehouses' => Warehouse::all(),
    ]);
}

public function update(Request $request, Package $package)
{
    $validated = $request->validate([
        'tracking_number' => 'required|string|unique:packages,tracking_number,' . $package->id,
        'client_id'       => 'required|exists:clients,id',
        'courier_id'      => 'required|exists:couriers,id',
        'weight'          => 'required|numeric|min:0.01',
        'status'          => 'required|in:odebrana,w_transporcie,w_punkcie,dostarczona'
    ]);
    

    $package->update($validated);
    return redirect()->route('admin.packages.index')->with('success', 'Przesyłka zaktualizowana.');
}

  public function my()
    {
        $user = auth()->user();
        $client = $user->client;

        if (!$client) {
            return view('packages.my', ['packages' => collect()]);
        }

        $packages = $client->packages()
            ->with(['pickupPoint'])
            ->latest()
            ->get();

        return view('packages.my', compact('packages'));
    }

    public function updateStatus(Request $request, Package $package)
    {
        $validated = $request->validate([
            'status' => 'required|in:odebrana,w_transporcie,w_punkcie,dostarczona'
        ]);
        
        DB::transaction(function () use ($package, $validated) {
            $package->update(['status' => $validated['status']]);
            
            PackageStatus::create([
                'package_id' => $package->id,
                'status'     => $validated['status'],
                'changed_at' => now(),
            ]);
        });

        return redirect()->back()->with('success', 'Status przesyłki został zaktualizowany.');
    }

    public function destroy(Package $package)
{
    // Używamy transakcji, aby bezpiecznie usunąć paczkę i jej historię
    DB::transaction(function () use ($package) {
        // 1. Usuwamy historię statusów przypisaną do tej paczki
        $package->statuses()->delete(); 
        
        // 2. Usuwamy samą paczkę
        $package->delete();
    });

    return redirect()
        ->route('admin.packages.index')
        ->with('success', 'Przesyłka ' . $package->tracking_number . ' została trwale usunięta.');
}
}