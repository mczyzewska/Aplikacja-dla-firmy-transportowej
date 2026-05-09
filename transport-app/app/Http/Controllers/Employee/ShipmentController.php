<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Shipment;
use App\Models\PickupPoint;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function create(Package $package)
    {
        return view('employee.shipments.create', [
            'package' => $package,
            'pickupPoints' => PickupPoint::all()
        ]);
    }

    public function store(Request $request)
    {
        Shipment::create($request->validate([
            'package_id' => 'required',
            'pickup_point_id' => 'required',
            'departure_date' => 'required|date'
        ]));

        return redirect()->route('employee.packages.index')
            ->with('success', 'Shipment created');
    }
}
