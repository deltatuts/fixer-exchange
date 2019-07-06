<?php

namespace Deltatuts\Fixer\Endpoint;

use Deltatuts\Fixer\Exception\InvalidCurrencyCodeException;
use Deltatuts\Fixer\Request\GetLatestExchangeRatesRequest;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class LatestExchangeRatesEndpoint
 * @package Deltatuts\Fixer\Endpoint
 */
class LatestExchangeRatesEndpoint extends AbstractBaseEndpoint
{
    const ENDPOINT_URI = 'latest';

    /**
     * Returns the latest spot price for the supported currencies.
     *
     * @param string $baseCurrency base currency alpha3 code (if different than EUR)
     * @param array $symbols array of alpha3 codes to filter the response
     *
     * @return ResponseInterface
     * @throws InvalidCurrencyCodeException
     * @throws GuzzleException
     */
    public function latest(string $baseCurrency = null, array $symbols = []): ResponseInterface
    {
        $params = [];
        if ($baseCurrency) {
            if (strlen($baseCurrency) != 3) {
                throw new InvalidCurrencyCodeException($baseCurrency);
            }
            $params['base'] = $baseCurrency;
        }

        if (!empty($symbols)) {
            $params['symbols'] = implode(',', $symbols);
        }

        $req = new GetLatestExchangeRatesRequest($this->buildUri($params));

        return $this->client->send($req);
    }
}
