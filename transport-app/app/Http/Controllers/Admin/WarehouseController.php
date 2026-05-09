<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Wyświetla listę wszystkich magazynów w Polsce.
     */
    public function index()
    {
        return view('admin.warehouses.index', [
            'warehouses' => Warehouse::all()
        ]);
    }

    /**
     * Pokazuje formularz tworzenia nowego magazynu.
     */
    public function create()
    {
        return view('admin.warehouses.create');
    }

    /**
     * Zapisuje nowy magazyn w bazie danych.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'is_main' => 'sometimes|boolean'
        ]);

        // Jeśli checkbox nie jest zaznaczony, ustawiamy na false
        $validated['is_main'] = $request->has('is_main');

        Warehouse::create($validated);

        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Magazyn został utworzony pomyślnie.');
    }

    /**
     * Pokazuje formularz edycji istniejącego magazynu.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    /**
     * Aktualizuje dane magazynu w bazie.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'is_main' => 'sometimes|boolean'
        ]);

        // Obsługa checkboxa is_main
        $validated['is_main'] = $request->has('is_main');

        $warehouse->update($validated);

        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Dane magazynu zostały zaktualizowane.');
    }

    /**
     * Usuwa magazyn z systemu.
     */
    public function destroy(Warehouse $warehouse)
    {
        // Opcjonalnie: sprawdź, czy w magazynie są paczki przed usunięciem
        $warehouse->delete();

        return back()->with('success', 'Magazyn został pomyślnie usunięty.');
    }
}