<?php

namespace App\Structural\Proxy;

interface CacheInterface
{
    public function set(string $key, $value, int $ttl): void;
    public function get(string $key);
    public function has(string $key): bool;
    public function delete(string $key): void;
}