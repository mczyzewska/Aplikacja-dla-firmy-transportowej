<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Imię i Nazwisko kierowcy
            $table->string('vehicle_number'); // Numer rejestracyjny pojazdu
            $table->string('phone');          // Telefon służbowy
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('couriers');
    }
};