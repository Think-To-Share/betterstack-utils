<?php

declare(strict_types=1);

namespace ThinkToShare\Betterstack;

use Exception;
use Illuminate\Support\Facades\Http;

class Heartbeat
{
    protected string $api_url;

    public function __construct()
    {
        $this->api_url = rtrim(config('betterstack.heartbeat_url', 'https://uptime.betterstack.com/api/v1/heartbeat'), '/');
    }

    public function beats(string $name): void
    {
        $this->call("{$this->api_url}/{$this->getHeartbeatKey($name)}");
    }

    public function failed(string $name): void
    {
        $this->call("{$this->api_url}/{$this->getHeartbeatKey($name)}/fail");
    }

    protected function getHeartbeatKey(string $name): string
    {
        $key = config("betterstack.heartbeats.{$name}");
        if (is_null($key)) {
            throw new Exception("No heartbeat exists with name: [{$name}]");
        }

        return $key;
    }

    protected function call(string $url): void
    {
        $response = Http::post($url);
        $response->throw();
    }
}
