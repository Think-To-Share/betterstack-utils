<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use ThinkToShare\Betterstack\Heartbeat;

beforeEach(function () {
    Config::set('betterstack.heartbeats.email', 'test_key');
});

it('can beats', function () {
    Http::fake();
    $a = new Heartbeat;
    $a->beats('email');

    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://uptime.betterstack.com/api/v1/heartbeat/test_key';
    });
});

it('can fails', function () {
    Http::fake();
    $a = new Heartbeat;
    $a->failed('email');

    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://uptime.betterstack.com/api/v1/heartbeat/test_key/fail';
    });
});

it('throws exception when heartbeat key does not exist', function () {
    $a = new Heartbeat;
    $a->beats('dummy');
})->throws(Exception::class, 'No heartbeat exists with name: [dummy]');

it('can use custom heartbeat url', function () {
    Config::set('betterstack.heartbeat_url', 'https://example.com');
    Http::fake();
    $a = new Heartbeat;
    $a->beats('email');

    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://example.com/test_key';
    });
});
