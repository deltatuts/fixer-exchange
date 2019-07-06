<?php

namespace Deltatuts\Fixer;

use Deltatuts\Fixer\Exception\MissingAPIKeyException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Class FixerHttpClient
 * @package Deltatuts\Fixer
 */
class FixerHttpClient extends Client
{
    /**
     * @var string
     */
    const BASE_URI = "http://data.fixer.io/api";

    /**
     * Time to wait in seconds before interrupting the request.
     *
     * @var string
     */
    const TIMEOUT = 5;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * FixerHttpClient constructor.
     *
     * @param string $key
     * @param array $config
     * @throws MissingAPIKeyException
     */
    public function __construct(string $key, array $config = [])
    {
        if (empty($key)) {
            throw new MissingAPIKeyException();
        }

        $this->apiKey = $key;
        $baseConfig = [
            'base_uri' => self::BASE_URI,
            RequestOptions::TIMEOUT => self::TIMEOUT
        ];
        parent::__construct(array_merge($baseConfig, $config));
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
