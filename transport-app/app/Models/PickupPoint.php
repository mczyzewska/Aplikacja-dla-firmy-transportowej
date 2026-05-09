<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;

    // Musisz mieć te pola, bo ich używasz w PickupPointSeeder oraz w widoku index.blade.php
    protected $fillable = [
        'name',
        'location',
        // Jeśli w migracji masz też te pola, możesz je zostawić:
        'country',
        'city',
        'address',
        'code'
    ];

    /**
     * Relacja do paczek - dzięki temu Package::with('pickupPoint') zadziała poprawnie.
     */
    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    /**
     * Opcjonalnie: Relacja do przesyłek, którą miałeś wcześniej.
     */
    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}