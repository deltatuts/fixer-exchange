<?php

namespace Deltatuts\Fixer\Endpoint;

use Deltatuts\Fixer\FixerHttpClient;
use GuzzleHttp\ClientInterface;

abstract class AbstractBaseEndpoint
{
    /**
     * Path to be appended after the base URI.
     *
     * @var string
     */
    public const ENDPOINT_URI = '';

    /**
     * HTTP GET method.
     *
     * @var string
     */
    public const GET = 'GET';

    /**
     * Keyword to pass the API key on each call.
     */
    public const ACCESS_PARAM = 'access_key';

    /**
     * @var FixerHttpClient
     */
    protected $client;

    /**
     * AbstractBaseEndpoint constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(FixerHttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Query parameters to be appended to the endpoint URI.
     */
    public function buildUri(array $params = []): string
    {
        $params[self::ACCESS_PARAM] = $this->client->getApiKey();

        $query = http_build_query($params);

        return join('?', [static::ENDPOINT_URI, $query]);
    }
}
