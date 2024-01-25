<?php

namespace App\Structural\Proxy;

use App\Structural\Adapter\ClientInterface;

class CachingProxy implements ClientInterface
{
    private ClientInterface $client;
    private CacheInterface $cache;
    
    public function __construct(ClientInterface $client, CacheInterface $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }
    
    public function get(string $url)
    {
        if ($this->cache->has($url)) {
            return $this->cache->get($url);
        }
        
        $response = $this->client->get($url);
        $this->cache->set($url, $response);
        
        return $response;
    }
}