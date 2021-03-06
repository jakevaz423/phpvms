<?php

namespace App\Models\Enums;

use App\Interfaces\Enum;

/**
 * Class PirepSource
 * @package App\Models\Enums
 */
class PirepSource extends Enum
{
    public const MANUAL = 0;
    public const ACARS  = 1;

    protected static $labels = [
        PirepSource::MANUAL => 'system.pireps.source.manual',
        PirepSource::ACARS  => 'system.pireps.source.acars',
    ];
}
