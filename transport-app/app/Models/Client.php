<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',   // DODANO: To pole jest niezbędne do powiązania z użytkownikiem
        'phone', 
        'address', 
        'nip'
    ];

    /**
     * Relacja do użytkownika (każdy profil klienta należy do jednego konta User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}