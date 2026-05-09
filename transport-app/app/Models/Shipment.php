<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'pickup_point_id',
        'departure_date',
        'arrival_date',
        'transport_method'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'arrival_date'   => 'date'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class);
    }
}
