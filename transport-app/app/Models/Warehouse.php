<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'is_main'
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
