<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $client = Auth::user();

        return view('client.dashboard.index', [
            'packages' => $client->packages,
            'invoices' => $client->invoices
        ]);
    }
}
