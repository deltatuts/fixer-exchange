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
     * @param $uri
     */
    public function __construct($uri)
    {
        parent::__construct(AbstractBaseEndpoint::GET, $uri);
    }
}
