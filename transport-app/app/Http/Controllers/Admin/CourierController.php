<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        // Przesyłamy tylko listę kurierów (kierowców)
        return view('admin.couriers.index', [
            'couriers' => Courier::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:15',
            'phone'          => 'required|string|max:20',
        ], [
            // Polskie tłumaczenia błędów
            'name.required'           => 'Imię i nazwisko kierowcy musi zostać uzupełnione.',
            'name.max'                => 'Imię i nazwisko nie może być dłuższe niż 255 znaków.',
            'vehicle_number.required' => 'Numer rejestracyjny pojazdu jest wymagany.',
            'vehicle_number.max'      => 'Numer rejestracyjny nie może przekraczać 15 znaków.',
            'phone.required'          => 'Numer telefonu kierowcy jest niezbędny do kontaktu.',
            'phone.max'               => 'Numer telefonu nie może być dłuższy niż 20 znaków.',
            'string'                  => 'Wprowadzona wartość musi być tekstem.',
        ]);

        Courier::create($validated);

        return redirect()->back()->with('success', 'Kierowca został pomyślnie dodany do floty.');
    }

    public function destroy(Courier $courier)
    {
        $courier->delete();
        return back()->with('success', 'Kierowca został usunięty z listy floty.');
    }
}