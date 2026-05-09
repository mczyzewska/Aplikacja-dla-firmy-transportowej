<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Pola, które można masowo przypisywać.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Pola ukryte przed serializacją.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Rzutowanie typów.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- STAŁE RÓL ---
    public const ROLE_ADMIN = 'admin';
    public const ROLE_EMPLOYEE = 'employee';
    public const ROLE_CLIENT = 'client';

    // --- RELACJE ---

    /**
     * Relacja 1:1 z profilem klienta.
     * Dzięki temu Admin może wywołać $user->client->nip
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    // --- POMOCNICZE METODY RÓL ---

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEmployee(): bool
    {
        return $this->role === self::ROLE_EMPLOYEE;
    }

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }
}