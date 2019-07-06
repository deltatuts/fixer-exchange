<?php

namespace Deltatuts\Fixer\Request;

use Deltatuts\Fixer\Endpoint\AbstractBaseEndpoint;
use GuzzleHttp\Psr7\Request;

/**
 * Class GetSupportedSymbolsRequest
 * @package Deltatuts\Fixer\Request
 */
class GetSupportedSymbolsRequest extends Request
{
    /**
     * GetSupportedSymbolsRequest constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        parent::__construct(AbstractBaseEndpoint::GET, $uri);
    }
}
