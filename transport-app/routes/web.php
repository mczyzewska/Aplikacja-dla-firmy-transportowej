<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\ClientController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\InvoiceController as ClientInvoiceController;

// --- Strona Główna ---
Route::view('/', 'home')->name('home');

// --- Trasy dostępne tylko po Zalogowaniu ---
Route::middleware(['auth'])->group(function () {

    // 1. Dashboard - Logika ról
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return match ($user->role) {
            'admin' => view('dashboards.admin'),
            'employee' => view('dashboards.employee'),
            default => view('dashboards.client'),
        };
    })->name('dashboard');

    // 2. Profil Użytkownika
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Zarządzanie Przesyłkami (Widok ogólny / Klient)
    Route::get('/my-packages', [PackageController::class, 'my'])->name('packages.my');

    // --- SEKCJA KLIENTA ---
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/invoices', [ClientInvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{invoice}', [ClientInvoiceController::class, 'show'])->name('invoices.show');
    });

    // --- PANEL ADMINISTRATORA (ZABEZPIECZONY) ---
    Route::prefix('admin')
        ->name('admin.')
        // DODANO: Middleware 'role' sprawdza uprawnienia przed wejściem
        ->middleware(['role:admin,employee']) 
        ->group(function () {
            
            Route::resource('warehouses', WarehouseController::class);
            Route::resource('couriers', CourierController::class);
            Route::resource('packages', PackageController::class);
            Route::resource('invoices', InvoiceController::class);
            Route::resource('users', UserController::class);
            
            Route::get('clients/{client}', [ClientController::class, 'show'])->name('clients.show');
            Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');
        });
});

require __DIR__.'/auth.php';