<?php

namespace Deltatuts\Fixer\Endpoint;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use Deltatuts\Fixer\Request\GetSupportedSymbolsRequest;

class SymbolsEndpoint extends AbstractBaseEndpoint
{
    public const ENDPOINT_URI = 'symbols';

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
