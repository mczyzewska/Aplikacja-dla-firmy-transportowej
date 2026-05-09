<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        return view('client.packages.index', [
            'packages' => Auth::user()->packages
        ]);
    }
}
