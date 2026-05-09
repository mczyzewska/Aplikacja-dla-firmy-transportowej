<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'total_price',
        'issue_date',
        'due_date',
        'nip',
        'status'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date'   => 'date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function getCalculatedTotalAttribute(): float
{
    return $this->items->sum(function ($item) {
        return $item->quantity * $item->price;
    });
}

}
