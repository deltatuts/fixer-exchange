<?php

namespace Deltatuts\Fixer\Request;

use Deltatuts\Fixer\Endpoint\AbstractBaseEndpoint;
use GuzzleHttp\Psr7\Request;

/**
 * Class GetLatestExchangeRatesRequest
 * @package Deltatuts\Fixer\Request
 */
class GetLatestExchangeRatesRequest extends Request
{
    /**
     * GetLatestExchangeRatesRequest constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        parent::__construct(AbstractBaseEndpoint::GET, $uri);
    }
}
