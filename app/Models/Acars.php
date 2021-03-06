<?php

namespace App\Models;

use App\Interfaces\Model;
use App\Models\Traits\HashIdTrait;

/**
 * Class Acars
 * @param string id
 * @package App\Models
 */
class Acars extends Model
{
    use HashIdTrait;

    public $table = 'acars';
    public $incrementing = false;

    public $fillable = [
        'pirep_id',
        'type',
        'nav_type',
        'order',
        'name',
        'log',
        'lat',
        'lon',
        'heading',
        'altitude',
        'vs',
        'gs',
        'transponder',
        'autopilot',
        'fuel_flow',
        'sim_time',
    ];

    public $casts = [
        'type'        => 'integer',
        'order'       => 'integer',
        'nav_type'    => 'integer',
        'lat'         => 'float',
        'lon'         => 'float',
        'heading'     => 'integer',
        'altitude'    => 'float',
        'vs'          => 'float',
        'gs'          => 'float',
        'transponder' => 'integer',
        'fuel_flow'   => 'float',
    ];

    public static $rules = [
        'pirep_id' => 'required',
    ];

    /**
     * FKs
     */

    public function pirep()
    {
        return $this->belongsTo(Pirep::class, 'pirep_id');
    }
}
