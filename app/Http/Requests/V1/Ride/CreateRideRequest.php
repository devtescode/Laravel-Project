<?php

namespace App\Http\Requests\V1\Ride;

use Illuminate\Foundation\Http\FormRequest;

class CreateRideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'user_id' => ['required', 'exists:users,id'],
            // 'driver_id' => ['nullable', 'exists:drivers,id'],
            'pickup_location' => ['required', 'string', 'max:255'],
            'dropoff_location' => ['required', 'string', 'max:255'],
            'pickup_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'pickup_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'dropoff_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'dropoff_lng' => ['nullable', 'numeric', 'between:-180,180'],
            'note' => ['nullable', 'string', 'max:500'],
            'rating' => ['nullable', 'numeric', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:500'],
            'fare' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'in:requested,accepted,in_progress,completed,canceled'],
            'pickup_time' => ['nullable', 'date'],
            'dropoff_time' => ['nullable', 'date', 'after_or_equal:pickup_time'],
        ];
    }

    public function calculateDistance()
    {
        $earthRadius = 6371; // Radius of the Earth in kilometers
    
        $lat1 = deg2rad($this->pickup_lat);
        $lng1 = deg2rad($this->pickup_lng);
        $lat2 = deg2rad($this->dropoff_lat);
        $lng2 = deg2rad($this->dropoff_lng);
    
        $latDelta = $lat2 - $lat1;
        $lngDelta = $lng2 - $lng1;
    
        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($lat1) * cos($lat2) *
             sin($lngDelta / 2) * sin($lngDelta / 2);
    
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earthRadius * $c; // Distance in kilometers
    
        return $distance;
    }
    
    public function calculateFare($distance)
    {
        $baseFare = 3.00; // Base fare in your currency
        $perKmRate = 1.50; // Rate per kilometer in your currency
        $fare = $baseFare + ($perKmRate * $distance);

        // Optionally, implement surge pricing or other modifiers
        // $fare *= $this->getSurgeMultiplier();

        return round($fare, 2); // Round to two decimal places
    }
}
