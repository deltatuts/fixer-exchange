<?php

namespace Deltatuts\Fixer\Request;

use GuzzleHttp\Psr7\Request;
use Deltatuts\Fixer\Endpoint\AbstractBaseEndpoint;

/**
 * Class GetLatestExchangeRatesRequest.
 */
class GetLatestExchangeRatesRequest extends Request
{
    /**
     * GetLatestExchangeRatesRequest constructor.
     */
    public function __construct(string $uri)
    {
        parent::__construct(AbstractBaseEndpoint::GET, $uri);
    }
}
