<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_name',
        'vehicle_color',
        'license_plate',
        'vehicle_type',
        'current_lat',
        'current_lng',
        'available',
        'license_number',
        'profile_complete',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
