<?php

namespace App\Structural\Adapter;

class DictionaryService
{
    private ClientInterface $client;
    
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
    
    public function lemma(string $word) : ?string
    {
        $response = $this->client->get("lemmas/en/$word");
        
        return $response['results'][0]['lexicalEntries'][0]['inflectionOf'][0]['text'] ?? null;
    }
    
    public function entries(string $word): ?array
    {
        $response = $this->client->get("entries/en/$word?fields=definitions%2Cexamples%2Cpronunciations&strictMatch=false");
        
        $entries = [];
        $lexicalEntries = $response['results'][0]['lexicalEntries'] ?? null;
        
        foreach ($lexicalEntries as $lexicalEntry) {
            $entry['lexicalCategory'] = $lexicalEntry['lexicalCategory']['text'] ?? null;
            
            foreach ($lexicalEntry['entries'] ?? [] as $item) {
                foreach ($item['senses'] ?? [] as $sense) {
                    $entry['definition'] = $sense['definitions'][0] ?? null;
                    $entry['example'] = $sense['examples'][0]['text'] ?? null;
                }
                
                $entry['pronunciation'] = $item['pronunciations'][0]['audioFile'] ?? null;
            }
            
            $entries[] = $entry;
            $entry = null;
        }
        
        return $entries;
    }
}