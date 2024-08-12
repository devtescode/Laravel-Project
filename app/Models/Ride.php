<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $table = 'rides';

    protected $fillable = [
        'user_id',
        'driver_id',
        'pickup_location',
        'dropoff_location',
        'pickup_lat',
        'pickup_lng',
        'dropoff_lat',
        'dropoff_lng',
        'note',
        'rating',
        'comment',
        'fare',
        'status',
        'pickup_time',
        'dropoff_time',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pickup_time' => 'datetime',
        'dropoff_time' => 'datetime',
        'fare' => 'decimal:2',
    ];

    /**
     * Get the user that owns the ride.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the driver associated with the ride.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'user_id');
    }
}
