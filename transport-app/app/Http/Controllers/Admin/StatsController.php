<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Package;
use App\Models\Invoice;

class StatsController extends Controller
{
    public function index()
    {
        return view('admin.stats.index', [
            'users' => User::count(),
            'packages' => Package::count(),
            'invoices' => Invoice::count(),
        ]);
    }
}
