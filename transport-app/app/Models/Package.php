<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'courier_id',
        'warehouse_id',
        'pickup_point_id',
        'tracking_number',
        'weight',
        'description',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    public function statuses()
    {
        return $this->hasMany(PackageStatus::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function pickupPoint()
{
    return $this->belongsTo(PickupPoint::class);
}
}
