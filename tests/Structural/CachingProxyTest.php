<?php

namespace Structural;

use App\Structural\Adapter\DictionaryService;
use App\Structural\Adapter\GuzzleAdapter;
use App\Structural\Proxy\CachingProxy;
use App\Structural\Proxy\DBCache;
use PHPUnit\Framework\TestCase;

class CachingProxyTest extends TestCase
{
    public function testGetCacheResponse()
    {
        $guzzleClient = new GuzzleAdapter();
        $cache = new DBCache();
        
        $cachingProxy = new CachingProxy($guzzleClient, $cache);
        
        $dictionaryService = new DictionaryService($cachingProxy);
        
        $requestUrl = "lemmas/en/books";
        
        $cache->delete($requestUrl);
        $this->assertFalse($cache->has($requestUrl));
        
        $response = $dictionaryService->lemma('books');
        $this->assertEquals('book', $response);
        $this->assertTrue($cache->has($requestUrl));
    }
}
