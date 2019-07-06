<?php

include 'vendor/autoload.php';

use Deltatuts\Fixer\Exception\InvalidCurrencyCodeException;
use Deltatuts\Fixer\Exception\MissingAPIKeyException;
use Deltatuts\Fixer\FixerHttpClient;
use GuzzleHttp\Exception\GuzzleException;

// Put your api key here
$key = '';

try {
    $client = new FixerHttpClient($key);
} catch (MissingAPIKeyException $e) {
    var_dump($e);
}

// Get the supported symbols
try {
    // Requires a paid plan
    $response = $client->rates->latest(null, ['MXN', 'USD']);

    print_r(json_decode($response->getBody()->getContents(), true));
} catch (GuzzleException $e) {
    var_dump($e);
} catch (InvalidCurrencyCodeException $e) {
}
