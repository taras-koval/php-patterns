<?php

namespace Structural;

use App\Structural\Adapter\DictionaryService;
use App\Structural\Adapter\GuzzleAdapter;
use PHPUnit\Framework\TestCase;

class GuzzleAdapterTest extends TestCase
{
    public function testLemmaReturnsCorrectResponse()
    {
        $guzzleClient = new GuzzleAdapter();
        $dictionaryService = new DictionaryService($guzzleClient);
        
        $response = $dictionaryService->lemma('books');
        
        $this->assertEquals('book', $response);
    }
    
    public function testEntryReturnsCorrectResponse()
    {
        $guzzleClient = new GuzzleAdapter();
        $dictionaryService = new DictionaryService($guzzleClient);
        
        $response = $dictionaryService->entries('book');
        
        $this->assertEquals([
            [
                "lexicalCategory" => "Noun",
                "definition" => "a set of tickets, stamps, matches, samples of cloth, etc., bound together",
                "example" => "a pattern book",
                "pronunciation" => "https://audio.oxforddictionaries.com/en/mp3/book__gb_1.mp3",
            ],
            [
                "lexicalCategory" => "Verb",
                "definition" => "leave suddenly",
                "example" => "they just ate your pizza and drank your soda and booked",
                "pronunciation" => "https://audio.oxforddictionaries.com/en/mp3/book__gb_1.mp3",
            ]
        ], $response);
    }
}
