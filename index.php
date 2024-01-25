<?php

use App\Structural\Proxy\DictionaryService;
use App\Structural\Proxy\GuzzleAdapter;

require_once 'vendor/autoload.php';

$guzzleClient = new GuzzleAdapter();
$dictionaryService = new DictionaryService($guzzleClient);

$response = $dictionaryService->entries('book');

dd($response);