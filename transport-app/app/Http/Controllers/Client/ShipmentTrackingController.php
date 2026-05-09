<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Package;

class ShipmentTrackingController extends Controller
{
    public function show($tracking_number)
    {
        $package = Package::where('tracking_number', $tracking_number)->firstOrFail();

        return view('client.shipments.show', [
            'package' => $package,
            'statuses' => $package->statuses
        ]);
    }
}
