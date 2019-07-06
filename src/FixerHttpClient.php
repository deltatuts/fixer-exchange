<?php

namespace Deltatuts\Fixer;

use Deltatuts\Fixer\Endpoint\LatestExchangeRatesEndpoint;
use Deltatuts\Fixer\Endpoint\SymbolsEndpoint;
use Deltatuts\Fixer\Exception\MissingAPIKeyException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Class FixerHttpClient
 * @package Deltatuts\Fixer
 */
class FixerHttpClient extends Client
{
    const BASE_URI = "http://data.fixer.io/api";

    /**
     * Time to wait in seconds before interrupting the request.
     */
    const TIMEOUT = 5;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var SymbolsEndpoint
     */
    public $symbols;

    /**
     * @var LatestExchangeRatesEndpoint
     */
    public $rates;

    /**
     * FixerHttpClient constructor.
     *
     * @param string $key
     * @param array $config
     * @throws MissingAPIKeyException
     */
    public function __construct(string $key, array $config = [])
    {
        if (empty($key)) {
            throw new MissingAPIKeyException();
        }

        $this->apiKey = $key;
        $baseConfig = [
            'base_uri' => self::BASE_URI,
            RequestOptions::TIMEOUT => self::TIMEOUT
        ];
        parent::__construct(array_merge($baseConfig, $config));
        $this->initEndpoints();
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Initializes all the supported endpoints.
     */
    private function initEndpoints()
    {
        $this->symbols = new SymbolsEndpoint($this);
        $this->rates = new LatestExchangeRatesEndpoint($this);
    }
}
