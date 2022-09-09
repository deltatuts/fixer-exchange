<?php

namespace Deltatuts\Fixer\Request;

use GuzzleHttp\Psr7\Request;
use Deltatuts\Fixer\Endpoint\AbstractBaseEndpoint;

/**
 * Class GetSupportedSymbolsRequest.
 */
class GetSupportedSymbolsRequest extends Request
{
    /**
     * GetSupportedSymbolsRequest constructor.
     */
    public function __construct(string $uri)
    {
        parent::__construct(AbstractBaseEndpoint::GET, $uri);
    }
}
