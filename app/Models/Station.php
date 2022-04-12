<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model {
    use HasFactory;

    protected $table = 'stations';
    protected $fillable = ['name', 'latitude', 'longitude', 'address', 'company_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function getStationsWithinRadius($latitude, $longitude, $radius) {
        $stations = $this->selectRaw('*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        return $stations;
    }
}
