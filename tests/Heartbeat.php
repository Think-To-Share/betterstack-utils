<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use ThinkToShare\Betterstack\Heartbeat;

beforeEach(function (): void {
    Config::set('betterstack.heartbeats.email', 'test_key');
});

it('can beats', function (): void {
    Http::fake();
    $a = new Heartbeat;
    $a->beats('email');

    Http::assertSent(fn(Request $request): bool => $request->url() === 'https://uptime.betterstack.com/api/v1/heartbeat/test_key');
});

it('can fails', function (): void {
    Http::fake();
    $a = new Heartbeat;
    $a->failed('email');

    Http::assertSent(fn(Request $request): bool => $request->url() === 'https://uptime.betterstack.com/api/v1/heartbeat/test_key/fail');
});

it('throws exception when heartbeat key does not exist', function (): void {
    $a = new Heartbeat;
    $a->beats('dummy');
})->throws(Exception::class, 'No heartbeat exists with name: [dummy]');

it('can use custom heartbeat url', function (): void {
    Config::set('betterstack.heartbeat_url', 'https://example.com');
    Http::fake();
    $a = new Heartbeat;
    $a->beats('email');

    Http::assertSent(fn(Request $request): bool => $request->url() === 'https://example.com/test_key');
});
