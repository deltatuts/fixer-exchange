<?php

namespace Deltatuts\Fixer\Endpoint;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use Deltatuts\Fixer\Request\GetLatestExchangeRatesRequest;
use Deltatuts\Fixer\Exception\InvalidCurrencyCodeException;

/**
 * Class LatestExchangeRatesEndpoint.
 */
class LatestExchangeRatesEndpoint extends AbstractBaseEndpoint
{
    public const ENDPOINT_URI = 'latest';

    /**
     * Returns the latest spot price for the supported currencies.
     *
     * @param string $baseCurrency base currency alpha3 code (if different than EUR)
     * @param array  $symbols      array of alpha3 codes to filter the response
     *
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
