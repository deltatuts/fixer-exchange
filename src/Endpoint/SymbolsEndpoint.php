<?php

namespace Deltatuts\Fixer\Endpoint;

use Deltatuts\Fixer\Request\GetSupportedSymbolsRequest;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class SymbolsEndpoint extends AbstractBaseEndpoint
{
    const ENDPOINT_URI = 'symbols';

    /**
     * Returns the list of supported symbols.
     *
     * @throws GuzzleException
     */
    public function supported(): ResponseInterface
    {
        $req = new GetSupportedSymbolsRequest($this->buildUri());
        return $this->client->send($req);
    }
}
