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

        // LOGIKA SEKWENCYJNEGO NUMEROWANIA
        $lastPackage = Package::where('tracking_number', 'LIKE', 'TRK%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastPackage) {
            // Wyciągamy cyfry z ostatniego numeru (np. "TRK200101" -> 200101)
            $lastNumber = (int) filter_var($lastPackage->tracking_number, FILTER_SANITIZE_NUMBER_INT);
            $suggestedNumber = 'TRK' . ($lastNumber + 1);
        } else {
            // Jeśli baza pusta, zacznij od TRK200000
            $suggestedNumber = 'TRK200000';
        }

        return view('packages.index', [
            'packages' => Package::with(['client', 'pickupPoint'])->latest()->get(),
            'clients' => Client::orderBy('name')->get(),
            'pickupPoints' => PickupPoint::orderBy('city')->get(),
            'couriers' => Courier::orderBy('name')->get(),
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
            'status'          => 'required|in:odebrana,w_transporcie,w_punkcie,dostarczona'
        ], [
            'tracking_number.unique' => 'Przesyłka o tym numerze już istnieje!',
        ]);

        DB::transaction(function () use ($validated) {
            $package = Package::create([
                'tracking_number' => $validated['tracking_number'],
                'client_id'       => $validated['client_id'],
                'pickup_point_id' => $validated['pickup_point_id'],
                'courier_id'      => $validated['courier_id'],
                'status'          => $validated['status'],
                // Wartości domyślne ukryte w widoku
                'warehouse_id'    => 1, 
                'weight'          => 1.0,
            ]);

            PackageStatus::create([
                'package_id' => $package->id,
                'status'     => $package->status,
                'changed_at' => now(),
            ]);
        });

        return redirect()->back()->with('success', 'Paczka dodana poprawnie.');
    }

    public function updateStatus(Request $request, Package $package)
    {
        $validated = $request->validate(['status' => 'required|in:odebrana,w_transporcie,w_punkcie,dostarczona']);
        
        DB::transaction(function () use ($package, $validated) {
            $package->update(['status' => $validated['status']]);
            PackageStatus::create([
                'package_id' => $package->id,
                'status'     => $validated['status'],
                'changed_at' => now(),
            ]);
        });

        return redirect()->back()->with('success', 'Status zaktualizowany.');
    }
    public function my()
{
    $user = auth()->user();

    // Pobieramy profil klienta powiązany z zalogowanym użytkownikiem
    $client = $user->client;

    // Jeśli użytkownik nie ma profilu klienta, zwracamy pustą kolekcję
    if (!$client) {
        return view('packages.my', ['packages' => collect()]);
    }

    // Pobieramy paczki należące do tego klienta wraz z relacjami
    $packages = $client->packages()
        ->with(['pickupPoint'])
        ->latest()
        ->get();

    return view('packages.my', compact('packages'));
}
}