<?php

namespace App\Models;

use App\Interfaces\Model;
use App\Models\Enums\AircraftStatus;
use App\Models\Traits\ExpensableTrait;

/**
 * Class Subfleet
 * @property int     id
 * @property string  type
 * @property string  name
 * @property string  ground_handling_multiplier
 * @property Fare[]  fares
 * @property float   cost_block_hour
 * @property float   cost_delay_minute
 * @property Airline airline
 * @package App\Models
 */
class Subfleet extends Model
{
    use ExpensableTrait;

    public $table = 'subfleets';

    public $fillable = [
        'airline_id',
        'type',
        'name',
        'turn_time',
        'fuel_type',
        'ground_handling_multiplier',
        'cargo_capacity',
        'fuel_capacity',
        'gross_weight',
    ];

    public $casts = [
        'airline_id'                 => 'integer',
        'turn_time'                  => 'integer',
        'cost_block_hour'            => 'float',
        'cost_delay_minute'          => 'float',
        'fuel_type'                  => 'integer',
        'ground_handling_multiplier' => 'float',
        'cargo_capacity'             => 'float',
        'fuel_capacity'              => 'float',
        'gross_weight'               => 'float',
    ];

    public static $rules = [
        'type'                       => 'required',
        'name'                       => 'required',
        'ground_handling_multiplier' => 'nullable|numeric',
    ];

    /**
     * @param $type
     */
    public function setTypeAttribute($type)
    {
        $type = str_replace([' ', ','], array('-', ''), $type);
        $this->attributes['type'] = $type;
    }

    /**
     * Relationships
     */

    /**
     * @return $this
     */
    public function aircraft()
    {
        return $this->hasMany(Aircraft::class, 'subfleet_id')
            ->where('status', AircraftStatus::ACTIVE);
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    public function fares()
    {
        return $this->belongsToMany(Fare::class, 'subfleet_fare')
            ->withPivot('price', 'cost', 'capacity');
    }

    public function flights()
    {
        return $this->belongsToMany(Flight::class, 'flight_subfleet');
    }

    public function ranks()
    {
        return $this->belongsToMany(Rank::class, 'subfleet_rank')
            ->withPivot('acars_pay', 'manual_pay');
    }
}
