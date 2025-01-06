<?php

declare(strict_types=1);

namespace ThinkToShare\Betterstack\Facades;

use Illuminate\Support\Facades\Facade;
use ThinkToShare\Betterstack\Heartbeat as HeartbeatRoot;

class Heartbeat extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return HeartbeatRoot::class;
    }
}
